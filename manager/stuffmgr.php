<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");	
	include_once("../classes/login.php");
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	 {
		header("Location: ../index.php");
		die(); // solve a security bug
	 }
	$db = Database::GetDatabase();
	$overall_error = false;
	if ($_GET['item']!="stuffmgr")	exit();
	if (!$overall_error && $_POST["mark"]=="savestuff")
	{	    
		$fields = array("`cat`","`name`","`detail`");
		$_POST["detail"] = addslashes($_POST["detail"]);		
		$values = array("'{$_POST[cbcomp]}'","'{$_POST[cbplans]}'","'{$_POST[pos]}'");
		if (!$db->InsertQuery('stuff',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=stuffmgr&act=new&msg=2');			
			//$_GET["item"] = "plansmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
			//echo $db->cmd;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");			
			header('location:?item=stuffmgr&act=new&msg=1');		    
			//$_GET["item"] = "plansmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editstuff")
	{		
	    $_POST["detail"] = addslashes($_POST["detail"]);	    
		$values = array("`cat`"=>"'{$_POST[cbcat]}'",
						"`name`"=>"'{$_POST[name]}'",						
		                "`detail`"=>"'{$_POST[detail]}'");
			
        $db->UpdateQuery("stuff",$values,array("id='{$_GET[cid]}'"));
		header('location:?item=stuffmgr&act=mgr');
		//$_GET["item"] = "plansmgr";
		//$_GET["act"] = "act";			
	}
	if ($_GET['act']=="new")
	{
	    $rows = $db->SelectAll("stuffsec","*",null,"id ASC");
        $cbsec = DbSelectOptionTag("cbsec",$rows,"secname",null,null,"select validate[required]");        
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='savestuff' />";
	}
	if ($_GET['act']=="edit")
	{	
		$row = $db->Select("stuff","*","id='{$_GET["cid"]}'",NULL);
		$sec = $db->SelectAll("stuffsec","*",null,"id ASC");
		$cat = $db->SelectAll("stuffcat","*",null,"id ASC");
		$cbsec = DbSelectOptionTag("cbsec",$sec,"name","{$row['sid']}",null,"select validate[required]");
		$cbcat = DbSelectOptionTag("cbcat",$sec,"name","{$row['sid']}",null,"select validate[required]");
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editstuff' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("stuff"," id",$_GET["cid"]);
		if ($db->CountAll("stuff")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=stuffmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت کالا ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul class="two-column">
			  <li>		  
				<a href="?item=stuffmgr&act=new">درج کالای جدید
					<span class="add-plan"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=stuffmgr&act=mgr" id="news" name="news">حذف/ویرایش کالاها
					<span class="edit-plan"></span>
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
			$("#frmstuffmgr").validationEngine();
			$("#cbsec").change(function(){
				$.get('ajaxcommand.php?stuffsec='+$(this).val(), function(data) {
						$('#cats').html(data);
				});
			});
    });
	</script>
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت کالا ها</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmstuffmgr" id="frmstuffmgr" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>	 
	 <div class="badboy"></div>	   
       <div class="badboy"></div>
       <p>
         <label for="name">گروه</label>
         <span>*</span>
       </p>
	   {$cbsec}
	   <div id="cats">
		   {$cbcat}
	   </div>
       <div class="badboy"></div>
       <p>
         <label for="name">نام کالا</label>
         <span>*</span>
       </p>    
       <input type="text" name="name" class="validate[required] subject" id="name" value='{$row[name]}'/>	   
	   <div class='badboy'></div>
  	   <p>
         <label for="detail">توضیحات</label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="detail" class="detail" id="detail" > {$row[detail]}</textarea>
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
	if ($_POST["mark"]=="srhplan")
	{	 			    
		$rows = $db->SelectAll(
				"stuff",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				null,
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{										
				header("Location:?item=stuffmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"stuff",
				"*",
				null,
				null,
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhplan")?$db->CountAll("plans"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
				    $rows[$i]["cat"] = GetCategoryName(($rows[$i]["cat"],"stuffcat");				    
					$rows[$i]["detail"] = (mb_strlen($rows[$i]["detail"])>50)?
					mb_substr(html_entity_decode(strip_tags($rows[$i]["detail"]), ENT_QUOTES, "UTF-8"), 0, 50,"UTF-8") . "..." :
					html_entity_decode(strip_tags($rows[$i]["detail"]), ENT_QUOTES, "UTF-8");						
					if ($i % 2==0)
					 {
							$rowsClass[] = "datagridevenrow";
					 }
					else
					{
							$rowsClass[] = "datagridoddrow";
					}					
					$rows[$i]["edit"] = "<a href='?item=stuffmgr&act=edit&sid={$rows[$i]["id"]}' class='edit-field'" .
							"style='text-decoration:none;'></a>";								
					$rows[$i]["delete"]=<<< del
					<a href="javascript:void(0)"
					onclick="DelMsg('{$rows[$i]['id']}',
						'از حذف این خبر اطمینان دارید؟',
					'?item=stuffmgr&act=del&pageNo={$_GET[pageNo]}&sid=');"
					 class='del-field' style='text-decoration:none;'></a>
del;
                }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "cat"=>"نام شرکت",
					        "name"=>"نام طرح",
							"detail"=>"توضیحات",							
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=stuffmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("name"=>"نام کالا",			  
              "detail"=>"توضیحات");
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
					    <li><span>مدیریت طرح ها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=stuffmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>
								<p class="search-form">
									<input type="text" id="txtsrh" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />									
									<a href="?item=stuffmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=stuffmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhplan" /> 
								{$msgs}
								{$gridcode} 
							</form>
					   </center>
					</div>
edit;
$html = $code;
}

	
return $html;
?>