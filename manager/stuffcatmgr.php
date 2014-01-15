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
   if ($_GET['item']=="stuffcatmgr")
   {
	if (!$overall_error && $_POST["mark"]=="savecat")
	{	    
		$fields = array("`secid`","`catname`","`latinname`","`describe`");		
		$values = array("'{$_POST[cbsec]}'","'{$_POST[catname]}'","'{$_POST[latinname]}'","'{$_POST[describe]}'");		
		if (!$db->InsertQuery('stuffcat',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=stuffcatmgr&act=new&msg=2');
			//exit();
			//$_GET["item"] = "catmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");
			header('location:?item=stuffcatmgr&act=new&msg=1');
			//$_GET["item"] = "catmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editcat")
	{		
	    //$_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("`secid`"=>"'{$_POST[cbsec]}'",
		                "`catname`"=>"'{$_POST[catname]}'",
						"`latinname`"=>"'{$_POST[latinname]}'",
						"`describe`"=>"'{$_POST[describe]}'");		
        $db->UpdateQuery("stuffcat",$values,array("id='{$_GET["cid"]}'"));
		header('location:?item=stuffcatmgr&act=mgr');
		//$_GET["item"] = "catmgr";
		//$_GET["act"] = "mgr";		
	}

	if ($overall_error)
	{
		$row = array("secid"=>$_POST['cbsec'],
		             "catname"=>$_POST['subject'],
					 "latinname"=>$_POST['latinname'],
					 "describe"=>$_POST['describe']);
	}
	
	
if ($_GET['act']=="new")
{
	$editorinsert = "
		<p>
			<input type='submit' id='submit' value='ذخیره' class='submit' />	 
			<input type='hidden' name='mark' value='savecat' />";
}
if ($_GET['act']=="edit")
{
	$row=$db->Select("stuffcat","*","id='{$_GET["cid"]}'",NULL);
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='editcat' />";
}
if ($_GET['act']=="del")
{
	$db->Delete("stuffcat"," id",$_GET["cid"]);
	//echo  $db->cmd;
	if ($db->CountAll("stuffcat")%10==0) $_GET["pageNo"]-=1;		
	header("location:?item=stuffcatmgr&act=mgr&pageNo={$_GET[pageNo]}");
}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>دسته بندی کالاها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul class="two-column">
			<li>		  
				<a href="?item=stuffsecmgr&act=new">کالای جدید
					<span class="add-headline"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=stuffsecmgr&act=mgr">حذف/ویرایش کالاها
					<span class="edit-headline"></span>
				</a>
			  </li>
			  <li>		  
				<a href="?item=stuffcatmgr&act=new">برند جدید
					<span class="add-cat"></span>
				</a>
			  </li>
			  
			  <li>
				<a href="?item=stuffcatmgr&act=mgr">حذف/ویرایش برندها
					<span class="edit-cat"></span>
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
$sections = $db->SelectAll("stuffsec","*",null,"secname ASC");
if ($_GET['act']=="edit")
	$cbsection = DbSelectOptionTag("cbsec",$sections,"secname","{$row[secid]}",null,"select validate[required]");
else
	$cbsection = DbSelectOptionTag("cbsec",$sections,"secname",null,null,"select validate[required]");	
$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){	   
			$("#frmcatmgr").validationEngine();			
    });
	</script>	   
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت برندها</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmcatmgr" id="frmcatmgr" class="" action="" method="post" >  
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="catname">نام برند </label>
         <span>*</span>
       </p>    
       <input type="text" name="catname" class="validate[required] catname family" id="catname" value='{$row[catname]}'/>
       <p>
         <label for="latinname">نام لاتین </label>
       </p>    
       <input type="text" name="latinname" class="latinname family ltr" id="latinname" value='{$row[latinname]}'/>
       <p>
         <label for="describe">توضیحات </label>
       </p>    
       <input type="text" name="describe" class="describe subject" id="describe" value='{$row[describe]}'/>
       <p>
         <label for="detail">انتخاب کالا </label>
         <span>*</span>
       </p>
       {$cbsection}
	   <div class="badboy"></div>
       <p>
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
	if ($_POST["mark"]=="srhcat")
	{
	   $rows = $db->SelectAll(
				"stuffcat",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"catname ASC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "catmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=stuffcatmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"stuffcat",
				"*",
				null,
				"catname ASC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhcat")?$db->CountAll("stuffcat"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["catname"] =(mb_strlen($rows[$i]["catname"])>20)?mb_substr($rows[$i]["catname"],0,20,"UTF-8")."...":$rows[$i]["catname"];
		        $rows[$i]["latinname"] =(mb_strlen($rows[$i]["latinname"])>20)?mb_substr($rows[$i]["latinname"],0,20,"UTF-8")."...":$rows[$i]["latinname"];
		        $rows[$i]["describe"] =(mb_strlen($rows[$i]["describe"])>50)?mb_substr($rows[$i]["describe"],0,50,"UTF-8")."...":$rows[$i]["describe"];
                              
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["secid"] = GetSectionName($rows[$i]["secid"],"stuffsec");
				$rows[$i]["edit"] = "<a href='?item=stuffcatmgr&act=edit&cid={$rows[$i]["id"]}' class='edit-field' " .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این گروه اطمینان دارید؟',
				'?item=stuffcatmgr&act=del&pageNo={$_GET[pageNo]}&cid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array(
					        "secid"=>"نام کالا",
							"catname"=>"نام برند",
							"latinname"=>"نام لاتین",
							"describe"=>"توضیحات",							
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=stuffcatmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("catname"=>"نام برند",
			  "latinname"=>"نام لاتین",
			  "describe"=>"توضیحات" );
$combobox = SelectOptionTag("cbsearch",$list,"subject");
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
					    <li><span>مدیریت برندها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=stuffcatmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>

								<p class="search-form">
									<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
									<a href="?item=stuffcatmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=stuffcatmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhcat" /> 
								{$msgs}

								{$gridcode} 
															
							</form>
					   </center>
					</div>

edit;
$html = $code;
}
} else
if ($_GET['item']=="stuffsecmgr")
{
if (!$overall_error && $_POST["mark"]=="savesec")
	{	    
		$fields = array("`secname`","`latinname`","`describe`");		
		$values = array("'{$_POST[secname]}'","'{$_POST[latinname]}'","'{$_POST[describe]}'");		
		if (!$db->InsertQuery('stuffsec',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=stuffsecmgr&act=new&msg=2');
			//echo $db->cmd;
				
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");
			header('location:?item=stuffsecmgr&act=new&msg=1');
			//$_GET["item"] = "secmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editsec")
	{			    
		$values = array("`secname`"=>"'{$_POST[secname]}'",
						"`latinname`"=>"'{$_POST[latinname]}'",
						"`describe`"=>"'{$_POST[describe]}'");		
        $db->UpdateQuery("stuffsec",$values,array("id='{$_GET["sid"]}'"));
		echo $db->cmd;
		header('location:?item=stuffsecmgr&act=mgr');
		//$_GET["item"] = "secmgr";
		//$_GET["act"] = "mgr";			
	}

	if ($overall_error)
	{
		$row = array("secname"=>$_POST['subject'],
					 "latinname"=>$_POST['latinname'],
					 "describe"=>$_POST['describe']);
	}
	
	
if ($_GET['act']=="new")
{
	$editorinsert = "
		<p>
			<input type='submit' id='submit' value='ذخیره' class='submit' />	 
			<input type='hidden' name='mark' value='savesec' />";
}
if ($_GET['act']=="edit")
{
	$row=$db->Select("stuffsec","*","id='{$_GET["sid"]}'",NULL);
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='editsec' />";
}
if ($_GET['act']=="del")
{
	$db->Delete("stuffsec"," id",$_GET["sid"]);
	if ($db->CountAll("stuffsec")%10==0) $_GET["pageNo"]-=1;		
	header("location:?item=stuffsecmgr&act=mgr&pageNo={$_GET[pageNo]}");
}
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){	   
			$("#frmsecmgr").validationEngine();			
    });
	</script>	   
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت کالاها</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmsecmgr" id="frmsecmgr" class="" action="" method="post" >  
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="catname">نام کالا </label>
         <span>*</span>
       </p>    
       <input type="text" name="secname" class="validate[required] catname family" id="secname" value='{$row[secname]}'/>
       <p>
         <label for="latinname">نام لاتین </label>
       </p>    
       <input type="text" name="latinname" class="latinname family ltr" id="latinname" value='{$row[latinname]}'/>
       <p>
         <label for="describe">توضیحات </label>
       </p>    
       <input type="text" name="describe" class="describe subject" id="describe" value='{$row[describe]}'/>       
	   <div class="badboy"></div>
       <p>
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
	if ($_POST["mark"]=="srhcat")
	{	 		
	   $rows = $db->SelectAll(
				"stuffsec",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"secname ASC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "secmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=stuffsecmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"stuffsec",
				"*",
				null,
				"secname ASC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhcat")?$db->CountAll("stuffsec"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["secname"] =(mb_strlen($rows[$i]["secname"])>20)?mb_substr($rows[$i]["secname"],0,20,"UTF-8")."...":$rows[$i]["secname"];
		        $rows[$i]["latinname"] =(mb_strlen($rows[$i]["latinname"])>20)?mb_substr($rows[$i]["latinname"],0,20,"UTF-8")."...":$rows[$i]["latinname"];
		        $rows[$i]["describe"] =(mb_strlen($rows[$i]["describe"])>50)?mb_substr($rows[$i]["describe"],0,50,"UTF-8")."...":$rows[$i]["describe"];
                              
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}				
				$rows[$i]["edit"] = "<a href='?item=stuffsecmgr&act=edit&sid={$rows[$i]["id"]}' class='edit-field' " .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این گروه اطمینان دارید؟',
				'?item=stuffsecmgr&act=del&pageNo={$_GET[pageNo]}&sid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array(					        
							"secname"=>"نام کالا",
							"latinname"=>"نام لاتین",
							"describe"=>"توضیحات",							
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=stuffsecmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("secname"=>"نام کالا",
			  "latinname"=>"نام لاتین",
			  "describe"=>"توضیحات" );
$combobox = SelectOptionTag("cbsearch",$list,"subject");
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
					    <li><span>مدیریت کالاها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=stuffsecmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>

								<p class="search-form">
									<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
									<a href="?item=stuffsecmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=stuffsecmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhcat" /> 
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