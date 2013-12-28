<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();
	$overall_error = false;
	if ($_GET['item']=="compmgr")
	{
	if (!$overall_error && $_POST["mark"]=="savecomp")
	{	    
		$fields = array("`name`","`body`");
		$_POST["body"] = addslashes($_POST["body"]);		
		$values = array("'{$_POST[name]}'","'{$_POST[body]}'");
		if (!$db->InsertQuery('company',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=compmgr&act=new&msg=2');			
			//$_GET["item"] = "compmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");			
			header('location:?item=compmgr&act=new&msg=1');		    
			//$_GET["item"] = "compmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editcomp")
	{		
	    $_POST["body"] = addslashes($_POST["body"]);	    
		$values = array("`name`"=>"'{$_POST[name]}'",
			            "`body`"=>"'{$_POST[body]}'");
			
        $db->UpdateQuery("company",$values,array("id='{$_GET[cid]}'"));
		header('location:?item=compmgr&act=mgr');
		//$_GET["item"] = "compmgr";
		//$_GET["act"] = "act";			
	}
	if ($_GET['act']=="new")
	{
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='savecomp' />";
	}
	if ($_GET['act']=="edit")
	{	
		$row=$db->Select("company","*","id='{$_GET["cid"]}'",NULL);
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editcomp' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("company"," id",$_GET["cid"]);
		if ($db->CountAll("company")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=compmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}
	if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت شرکت</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=compmgr&act=new">درج شرکت جدید
					<span class="add-comp"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=compmgr&act=mgr" id="news" name="news">حذف/ویرایش شرکتها
					<span class="edit-comp"></span>
				</a>
			  </li>
		      <li>		  
				<a href="?item=gplanmgr&act=new">درج گروه های پلان
					<span class="add-comp"></span>
				</a>
			  </li>
			  <li>		  
				<a href="?item=gplanmgr&act=mgr">حذف/ویرایش  گروه پلان
					<span class="add-comp"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){	   
			$("#frmcompanymgr").validationEngine();			
		});
	</script>
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت شرکت</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmcompanymgr" id="frmcompanymgr" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>	 
       <div class="badboy"></div>
       <p>
         <label for="name">عنوان شرکت</label>
         <span>*</span>
       </p>    
       <input type="text" name="name" class="validate[required] subject" id="name" value='{$row[name]}'/>   	  
	   <div class="badboy"></div>
  	   <p>
         <label for="body">توضیحات</label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="body" class="body" id="body" > {$row[body]}</textarea>  	   
	   {$editorinsert}
      	 <input type="reset" value="پاک کردن" class='reset' />
       </p>  
	</form>
	<div class='badboy'></div>	
  </div>  
   
cd;
} else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 			    
		$rows = $db->SelectAll(
				"company",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				null,
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "compmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=compmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"company",
				"*",
				null,
				null,
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("company"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
					$rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>50)?
					mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 50,"UTF-8") . "..." :
					html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");						
					if ($i % 2==0)
					 {
							$rowsClass[] = "datagridevenrow";
					 }
					else
					{
							$rowsClass[] = "datagridoddrow";
					}					
					$rows[$i]["edit"] = "<a href='?item=compmgr&act=edit&cid={$rows[$i]["id"]}' class='edit-field'" .
							"style='text-decoration:none;'></a>";								
					$rows[$i]["delete"]=<<< del
					<a href="javascript:void(0)"
					onclick="DelMsg('{$rows[$i]['id']}',
						'از حذف این خبر اطمینان دارید؟',
					'?item=compmgr&act=del&pageNo={$_GET[pageNo]}&cid=');"
					 class='del-field' style='text-decoration:none;'></a>
del;
                }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "name"=>"نام شرکت",
							"body"=>"توضیحات",							
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=compmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("name"=>"نام شرکت",
              "body"=>"توضیحات");
$combobox = SelectOptionTag("cbsearch",$list,"name");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});		
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span>مدیریت شرکت</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=compmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>
								<p class="search-form">
									<input type="text" id="txtsrh" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 																	
									<a href="?item=compmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=compmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhnews" /> 
								{$msgs}
								{$gridcode} 
							</form>
					   </center>
					</div>

edit;
$html = $code;
}
}
else 
if ($_GET["item"]=="gplanmgr")
{
	if (!$overall_error && $_POST["mark"]=="savegplan")
	{	    
		$fields = array("`compid`,`subject`");				
		$values = array("'{$_POST[cbcomp]}'","'{$_POST[subject]}'");
		if (!$db->InsertQuery('plangroups',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=gplanmgr&act=new&msg=2');			
			//$_GET["item"] = "gplanmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");			
			header('location:?item=gplanmgr&act=new&msg=1');		    
			//$_GET["item"] = "gplanmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editgplan")
	{			    	    
		$values = array("`compid`"=>"'{$_POST[cbcomp]}'",
			            "`subject`"=>"'{$_POST[subject]}'");
			
        $db->UpdateQuery("plangroups",$values,array("id='{$_GET[pid]}'"));
		header('location:?item=gplanmgr&act=mgr');
		//$_GET["item"] = "gplanmgr";
		//$_GET["act"] = "act";			
	}
	if ($_GET['act']=="new")
	{
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='savegplan' />";
	}
	if ($_GET['act']=="edit")
	{	
		$row=$db->Select("plangroups","*","id='{$_GET["pid"]}'",NULL);
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editgplan' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("plangroups"," id",$_GET["pid"]);
		if ($db->CountAll("plangroups")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=gplanmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}	
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
	$comp = $db->SelectAll("company","*",null,"id ASC");
	if ($_GET['act']=="edit")
		$cbcomp = DbSelectOptionTag("cbcomp",$comp,"name","{$row[compid]}",null,"select validate[required]");
	else
		$cbcomp = DbSelectOptionTag("cbcomp",$comp,"name",null,null,"select validate[required]");
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){	   
			$("#frmgplanmgr").validationEngine();			
		});
	</script>
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت گروهبندی پلان</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmgplanmgr" id="frmgplanmgr" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>	 
       <div class="badboy"></div>
       <p>
         <label for="name">نام شرکت</label>         
         <span>*</span>
       </p>
		{$cbcomp}
		<div class="badboy"></div>
       <p>
         <label for="name">عنوان گروه</label>         
         <span>*</span>
       </p>    
       <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row[subject]}'/>   	  
	   <div class="badboy"></div>  	    	   
	   {$editorinsert}
      	 <input type="reset" value="پاک کردن" class='reset' />
       </p>  
	</form>
	<div class='badboy'></div>	
  </div>  
   
cd;
} else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhgplan")
	{	 			    
		$rows = $db->SelectAll(
				"plangroups",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				null,
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "gplansmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=gplanmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"plangroups",
				"*",
				null,
				null,
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhgplan")?$db->CountAll("plangroups"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
					if ($i % 2==0)
					 {
							$rowsClass[] = "datagridevenrow";
					 }
					else
					{
							$rowsClass[] = "datagridoddrow";
					}
					$rows[$i]["compid"] = GetPlanName($rows[$i]["compid"]);
					$rows[$i]["edit"] = "<a href='?item=gplanmgr&act=edit&pid={$rows[$i]["id"]}' class='edit-field'" .
							"style='text-decoration:none;'></a>";								
					$rows[$i]["delete"]=<<< del
					<a href="javascript:void(0)"
					onclick="DelMsg('{$rows[$i]['id']}',
						'از حذف این خبر اطمینان دارید؟',
					'?item=gplanmgr&act=del&pageNo={$_GET[pageNo]}&pid=');"
					 class='del-field' style='text-decoration:none;'></a>
del;
                }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "compid"=>"نام شرکت",
							"subject"=>"نام گروه طرح",							
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=gplanmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("name"=>"نام گروه طرح");
$combobox = SelectOptionTag("cbsearch",$list,"name");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});		
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span>مدیریت گروهبندی طرح ها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=gplanmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>
								<p class="search-form">
									<input type="text" id="txtsrh" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 																	
									<a href="?item=gplanmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=gplanmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhgplan" /> 
								{$msgs}
								{$gridcode} 
							</form>
					   </center>
					</div>

edit;
$html = $code;
}						
}
   
return $html;
?>