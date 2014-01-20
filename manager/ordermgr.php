<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
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
    if ($_GET['item']!="ordermgr")	exit();

  if ($_GET['act']=="view")  
  {
  	 $row=$db->Select("orders","*","id='{$_GET["oid"]}'",NULL);
  	 $prow=$db->Select("plans","name","id='{$row["pid"]}'",NULL);
  	 $srow=$db->Select("stuff","name","id='{$row["pid"]}'",NULL);
  	 $trow=$db->Select("trafic","*","id='{$row["pid"]}'",NULL);
  	 switch($row["otype"])
				{
				 case 1: $order = "ثبت سرویس جدید "." ".$prow[0]; break;
				 case 2: $order = "تمدید سرویس"." ".$prow[0]; break;
				 case 3: $order = "خرید کالا"." ".$srow[0]; break;
				 case 4: $order = "خرید ترافیک اضافه"." ".$trow["subject"]."  از شرکت  ".GetCompanyName($trow["pid"]); break;
				}   
  	$html=<<<cd
		<div class="title">
		      <ul>
		        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
			    <li><span>مدیریت سفارشات</span></li>
		      </ul>
		      <div class="badboy"></div>
	    </div>
		<div class='content'>
			<form action="" method="post" name="frmorder" id="frmorder">
     			<p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
	 			<div class="badboy"></div>
				<p>
					<label>نام و نام خانوادگی</label>
					<span>*</span>
				</p>
					<input type="text" name="name" class="name text" style="float:right;" value="{$row[name]}">
		 			<div class="badboy"></div>
				<p>
					<label>ایمیل</label>
					<span>*</span>
				</p>
					<input type="text" name="email" class="name text ltr" style="float:right;" value="{$row[email]}">
		 			<div class="badboy"></div>
				<p>
					<label>شماره تلفن</label>
					<span>*</span>
				</p>
					<input type="text" name="tel" class="name text ltr" style="float:right;" value="{$row[tel]}">
		 			<div class="badboy"></div>
				<p>
					<label>شماره موبایل</label>
					<span>*</span>
				</p>
					<input type="text" name="mobile" class="name text ltr" style="float:right;" value="{$row[mobile]}">
		 			<div class="badboy"></div>
				<p>
					<label>کد ملی</label>
					<span>*</span>
				</p>
					<input type="text" name="ncode" class="name text ltr" style="float:right;" value="{$row[ncode]}">
		 			<div class="badboy"></div>
				<p>
					<label>درخواست</label>
					<span>*</span>
				</p>
				<p>
					<b>{$order}</b>
				</p>	
				<textarea name="body" style="min-width:450px;float:right" class="text textarea">{$row[body]}</textarea>
			</form>
			<div class="badboy"></div>
	</div>	
cd;
  }
  else    
    if ($_GET['act']=="mgr" or $_GET['act']=="do")
{
	if ($_POST["mark"]=="srhnews")
	{	 		
	    if ($_POST["cbsearch"]=="ndate")
		{
		   date_default_timezone_set('Asia/Tehran');		   
		   list($year,$month,$day) = explode("/", trim($_POST["txtsrh"]));		
		   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
		   $_POST["txtsrh"] = Date("Y-m-d",mktime(0, 0, 0, $gmonth, $gday, $gyear));
		}
		$rows = $db->SelectAll(
				"orders",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"regdate DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				header("Location:?item=ordermgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"orders",
				"*",
				null,
				"regdate DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("orders"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {								        
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");                
                switch($rows[$i]["otype"])
				{
				 case 1: {$rows[$i]["pid"] =GetADSLName($rows[$i]["pid"]);
				          $rows[$i]["otype"] = "ثبت سرویس "; break;}
				 case 2: {$rows[$i]["otype"] = "تمدید سرویس"; 
				          $rows[$i]["pid"] =GetADSLName($rows[$i]["pid"]); break;}
				 case 3: {$rows[$i]["otype"] = "خرید کالا"; 
				          $rows[$i]["pid"] =GetstuffName($rows[$i]["pid"]); break; }
				 case 4: {$rows[$i]["otype"] = "خرید ترافیک "; 
				          $rows[$i]["pid"] =GetTraficName($rows[$i]["pid"]); break; }
				}           
                $rows[$i]["regdate"] =ToJalali($rows[$i]["regdate"]," l d F  Y ");
				$rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";                                            
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}				
				$rows[$i]["view"] = "<a href='?item=ordermgr&act=view&oid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این سفارش اطمینان دارید؟',
				'?item=ordermgr&act=del&pageNo={$_GET[pageNo]}&oid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "pid"=>"کالا",
							"otype"=>"نوع خرید",
							"name"=>"نام",
						//	"email"=>"ایمیل",
							"tel"=>"تلفن",
							"mobile"=>"موبایل",							
							"ncode"=>"کدملی",
                    		"body"=>"توضیحات",
                    		"regdate"=>"تاریخ",
                            "view"=>"نمایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=ordermgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("name"=>"نام",
			  //"email"=>"ایمیل",
			  "tel"=>"تلفن",
			  "mobile"=>"موبایل",
              "ncode"=>"کد ملی",
              "body"=>"توضیحات",
			  "regdatedate"=>"تاریخ",
			  );
$combobox = SelectOptionTag("cbsearch",$list,"subject");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});
		$('#cbsearch').change(function(){
			$("select option:selected").each(function(){
	            if($(this).val()=="ndate"){
	            	$('.cal-btn').css('display' , 'inline-block');
	            	return false;
	            }else{
	            	$('.cal-btn').css('display' , 'none');
	            }
  			});
		});
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span>مدیریت سفارشات</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=ordermgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>

								<p class="search-form">
									<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
									<img src="./images/cal.png" class="cal-btn" id="date_btn_2" alt="cal-pic">
							         <script type="text/javascript">
							          Calendar.setup({
							            inputField  : "date_input_1",   // id of the input field
							            button      : "date_btn_2",   // trigger for the calendar (button ID)
							                ifFormat    : "%Y/%m/%d",       // format of the input field
							                showsTime   : false,
							                dateType  : 'jalali',
							                showOthers  : true,
							                langNumbers : true,
							                weekNumbers : true
							          });
							        </script>
									<a href="?item=ordermgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=ordermgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
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
return $html;