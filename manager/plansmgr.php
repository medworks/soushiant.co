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
if ($_GET['item']=="plansmgr")
{
	if ($_GET['item']!="plansmgr")	exit();
	if (!$overall_error && $_POST["mark"]=="saveplan")
	{	    
		$fields = array("`sid`","`pid`","`pos`","`name`","`speeddl`","`speedup`",
		"`time`","`trafic`","`price`","`detail`");
		$_POST["detail"] = addslashes($_POST["detail"]);		
		$values = array("'{$_POST[cbcomp]}'","'{$_POST[cbplans]}'","'{$_POST[pos]}'",
		"'{$_POST[name]}'","'{$_POST[speeddl]}'","'{$_POST[speedup]}'","'{$_POST[time]}'",
		"'{$_POST[trafic]}'","'{$_POST[price]}'","'{$_POST[detail]}'");
		if (!$db->InsertQuery('plans',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=plansmgr&act=new&msg=2');			
			//$_GET["item"] = "plansmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
			//echo $db->cmd;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");			
			header('location:?item=plansmgr&act=new&msg=1');		    
			//$_GET["item"] = "plansmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editplan")
	{		
	    $_POST["detail"] = addslashes($_POST["detail"]);	    
		$values = array("`sid`"=>"'{$_POST[cbcomp]}'",
						"`pid`"=>"'{$_POST[cbplans]}'",
						"`pos`"=>"'{$_POST[pos]}'",
		                "`name`"=>"'{$_POST[name]}'",
						"`speeddl`"=>"'{$_POST[speeddl]}'",
						"`speedup`"=>"'{$_POST[speedup]}'",
						"`time`"=>"'{$_POST[time]}'",
						"`trafic`"=>"'{$_POST[trafic]}'",
						"`price`"=>"'{$_POST[price]}'",
			            "`detail`"=>"'{$_POST[detail]}'");
			
        $db->UpdateQuery("plans",$values,array("id='{$_GET[cid]}'"));
		header('location:?item=plansmgr&act=mgr');
		//$_GET["item"] = "plansmgr";
		//$_GET["act"] = "act";			
	}
	if ($_GET['act']=="new")
	{
	    $rows = $db->SelectAll("company","*",null,"id ASC");
        $cbcomp = DbSelectOptionTag("cbcomp",$rows,"name",null,null,"select validate[required]");        
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='saveplan' />";
	}
	if ($_GET['act']=="edit")
	{	
		$row = $db->Select("plans","*","id='{$_GET["cid"]}'",NULL);
		$comps = $db->SelectAll("company","*",null,"id ASC");
		$plans = $db->SelectAll("plangroups","*",null,"id ASC");
		$cbcomp = DbSelectOptionTag("cbcomp",$comps,"name","{$row['sid']}",null,"select validate[required]");
		$cbplans = DbSelectOptionTag("cbplans",$plans,"subject","{$row['pid']}",null,"select validate[required]");
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editplan' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("plans"," id",$_GET["cid"]);
		if ($db->CountAll("plans")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=plansmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت طرح ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul class="two-column">
			  <li>		  
				<a href="?item=plansmgr&act=new">درج طرح جدید
					<span class="add-plan"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=plansmgr&act=mgr" id="news" name="news">حذف/ویرایش طرحها
					<span class="edit-plan"></span>
				</a>
			  </li>
			  <li>		  
				<a href="?item=traficmgr&act=new">درج ترافیک
					<span class="add-vol"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=traficmgr&act=mgr" >حذف/ویرایش ترافیک
					<span class="edit-vol"></span>
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
			$("#frmplansmgr").validationEngine();
			$("#cbcomp").change(function(){
				$.get('ajaxcommand.php?comp='+$(this).val(), function(data) {
						$('#plans').html(data);
				});
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
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmplansmgr" id="frmplansmgr" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>	 
	 <div class="badboy"></div>	   
       <div class="badboy"></div>
       <p>
         <label for="name">نام شرکت</label>
         <span>*</span>
       </p>
	   {$cbcomp}
	   <div id="plans">
		   {$cbplans}
	   </div>
       <div class="badboy"></div>
       <p>
         <label for="name">نام طرح</label>
         <span>*</span>
       </p>    
       <input type="text" name="name" class="validate[required] subject" id="name" value='{$row[name]}'/>	   
	   <div class="badboy"></div>
       <p>
         <label for="name">سرعت دانلود</label>
         <span>*</span>
       </p>    
       <input type="text" name="speeddl" class="validate[required] subject" id="speeddl" value='{$row[speeddl]}'/> 
		<div class="badboy"></div>
       <p>
         <label for="name">سرعت آپلود</label>
         <span>*</span>
       </p>    
       <input type="text" name="speedup" class="validate[required] subject" id="speedup" value='{$row[speedup]}'/>
		<div class="badboy"></div>
       <p>
         <label for="name">مدت زمان طرح (عدد)</label>
         <span>*</span>
       </p>    
       <input type="text" name="time" class="validate[required] subject" id="time" value='{$row[time]}'/> 
		<div class="badboy"></div>
       <p>
         <label for="name">میزان ترافیک (GB)</label>
         <span>*</span>
       </p>    
       <input type="text" name="trafic" class="validate[required] subject" id="trafic" value='{$row[trafic]}'/>
		<div class="badboy"></div>
       <p>
         <label for="name">هزینه دوره(ریال)</label>
         <span>*</span>
       </p>    
       <input type="text" name="price" class="validate[required] subject" id="price" value='{$row[price]}'/> 	   
	   <div class="badboy"></div>
  	   <!-- <p>
         <label for="detail">توضیحات</label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="detail" class="detail" id="detail" > {$row[detail]}</textarea>
       -->
       <p>
         <label for="pos">ترتیب نمایش</label>
         <span>*</span>         
       </p>
	   <input type="text" name="pos" class="validate[required] subject" id="name" value='{$row[pos]}'/>	   
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
				"plans",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				null,
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "plansmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=plansmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"plans",
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
				    $rows[$i]["sid"] = GetCompanyName($rows[$i]["sid"]);					
				    $rows[$i]["pid"] = GetPlanName($rows[$i]["pid"]);
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
					$rows[$i]["edit"] = "<a href='?item=plansmgr&act=edit&cid={$rows[$i]["id"]}' class='edit-field'" .
							"style='text-decoration:none;'></a>";								
					$rows[$i]["delete"]=<<< del
					<a href="javascript:void(0)"
					onclick="DelMsg('{$rows[$i]['id']}',
						'از حذف این خبر اطمینان دارید؟',
					'?item=plansmgr&act=del&pageNo={$_GET[pageNo]}&cid=');"
					 class='del-field' style='text-decoration:none;'></a>
del;
                }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "sid"=>"نام شرکت",
                            "pid"=>"نام پلان",
					        "name"=>"نام طرح",							
							"speeddl"=>"سرعت دانلود",
							"speedup"=>"سرعت آپلود",
							"time"=>"مدت دوره",
							"trafic"=>"ترافیک(GB)",
							"price"=>"هزینه(تومان)",
							"detail"=>"توضیحات",
							"pos"=>"مکان نمایش",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=plansmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("name"=>"نام طرح",
              "speeddl"=>"سرعت دانلود",
			  "speedup"=>"سرعت آپلود",
			  "time"=>"مدت دوره",
			  "trafic"=>"ترافیک(GB)",
			  "price"=>"هزینه(تومان)",
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
							<form action="?item=plansmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>
								<p class="search-form">
									<input type="text" id="txtsrh" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />									
									<a href="?item=plansmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=plansmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
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
} else
if ($_GET['item']=="traficmgr")
{
	if (!$overall_error && $_POST["mark"]=="savetrafic")
	{	    
		$fields = array("`pid`","`subject`","`cnt`","`price`");		
		$values = array("'{$_POST[comp]}'","'{$_POST[subject]}'","'{$_POST[count]}'","'{$_POST[price]}'");
		if (!$db->InsertQuery('trafic',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=traficmgr&act=new&msg=2');			
			//$_GET["item"] = "traficmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");			
			header('location:?item=traficmgr&act=new&msg=1');		    
			//$_GET["item"] = "traficmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="edittrafic")
	{			    
		$values = array("`pid`"=>"'{$_POST[comp]}'",
						"`subject`"=>"'{$_POST[subject]}'",
		                "`cnt`"=>"'{$_POST[count]}'",
						"`price`"=>"'{$_POST[price]}'");
			
        $db->UpdateQuery("trafic",$values,array("id='{$_GET[tid]}'"));
		header('location:?item=traficmgr&act=mgr');
		//$_GET["item"] = "traficmgr";
		//$_GET["act"] = "act";			
	}
	if ($_GET['act']=="new")
	{
	    $rows = $db->SelectAll("company","*",null,"id ASC");
        $cbcomp = DbSelectOptionTag("comp",$rows,"name",null,null,"select validate[required]");
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='savetrafic' />";
	}
	if ($_GET['act']=="edit")
	{	
		$row = $db->Select("trafic","*","id='{$_GET["tid"]}'",NULL);
		$comps = $db->SelectAll("company","*",null,"id ASC");
		$cbcomp = DbSelectOptionTag("comp",$comps,"name","{$row['pid']}",null,"select validate[required]");
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='edittrafic' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("trafic"," id",$_GET["cid"]);
		if ($db->CountAll("plans")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=traficmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت طرح ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=plansmgr&act=new">درج طرح جدید
					<span class="add-plan"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=plansmgr&act=mgr" id="news" name="news">حذف/ویرایش طرحها
					<span class="edit-plan"></span>
				</a>
			  </li>
			  <li>		  
				<a href="?item=traficmgr&act=new">درج ترافیک
					<span class="add-plan"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=traficmgr&act=mgr" >حذف/ویرایش ترافیک
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
			$("#frmtraficmgr").validationEngine();
    	});
	</script>
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت طرح ها</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmtraficmgr" id="frmtraficmgr" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>	 
	 <div class="badboy"></div>	   
       <div class="badboy"></div>
       <p>
         <label for="name">نام شرکت</label>
         <span>*</span>
       </p>
	   {$cbcomp}
       <div class="badboy"></div>
       <p>
         <label for="subject">عنوان</label>
         <span>*</span>
       </p>    
       <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row[subject]}'/>
	   <div class="badboy"></div>
       <p>
         <label for="count">میزان ترافیک (GB)</label>
         <span>*</span>
       </p>    
       <input type="text" name="count" class="validate[required] subject" id="count" value='{$row[cnt]}'/> 
		<div class="badboy"></div>
       <p>
         <label for="price">قیمت (ریال)</label>
         <span>*</span>
       </p>    
       <input type="text" name="price" class="validate[required] subject" id="price" value='{$row[price]}'/>
	   
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
	if ($_POST["mark"]=="srhtrafic")
	{	 			    
		$rows = $db->SelectAll(
				"trafic",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				null,
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "traficmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=traficmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"trafic",
				"*",
				null,
				null,
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhtrafic")?$db->CountAll("plans"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
				    $rows[$i]["pid"] = GetCompanyName($rows[$i]["pid"]);
					if ($i % 2==0)
					 {
							$rowsClass[] = "datagridevenrow";
					 }
					else
					{
							$rowsClass[] = "datagridoddrow";
					}					
					$rows[$i]["edit"] = "<a href='?item=traficmgr&act=edit&tid={$rows[$i]["id"]}' class='edit-field'" .
							"style='text-decoration:none;'></a>";								
					$rows[$i]["delete"]=<<< del
					<a href="javascript:void(0)"
					onclick="DelMsg('{$rows[$i]['id']}',
						'از حذف این خبر اطمینان دارید؟',
					'?item=traficmgr&act=del&pageNo={$_GET[pageNo]}&tid=');"
					 class='del-field' style='text-decoration:none;'></a>
del;
                }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "pid"=>"نام شرکت",
					        "subject"=>"عنوان",
							"cnt"=>"میزان ( GB )",
							"price"=>"قیمت ( ریال )",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=traficmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "cnt"=>"میزان",
			  "price"=>"قیمت");
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
					    <li><span>مدیریت طرح ها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=plansmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>
								<p class="search-form">
									<input type="text" id="txtsrh" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />									
									<a href="?item=traficmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=traficmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhtrafic" /> 
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