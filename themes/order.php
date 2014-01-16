<?php
header('Content-Type: text/html; charset=UTF-8');

    include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");
	include_once("./classes/functions.php");	
	$db = Database::GetDatabase();
	
	if ($_GET["type"]=="product") $_POST[otype]=3; // buy stuff
	if ($_POST["mark"]=="saveorder")
	{	    
		$date = date('Y-m-d H:i:s');
		$fields = array("`pid`","`otype`","`name`","`email`","`tel`","`mobile`",
		"`ncode`","`body`","`regdate`");
		$_POST["body"] = addslashes($_POST["body"]);		
		$values = array("'{$_GET[pid]}'","'{$_POST[otype]}'","'{$_POST[name]}'",
		"'{$_POST[email]}'","'{$_POST[tel]}'","'{$_POST[mobile]}'","'{$_POST[ncode]}'",
		"'{$_POST[body]}'","'{$date}'");
		if (!$db->InsertQuery('orders',$fields,$values)) 
		{
			header('location:index.php?item=odr&msg=2');
			//echo $db->cmd;						
		} 	
		else 
		{  														
			header('location:index.php?item=odr&msg=1');
			//echo $db->cmd;		    
		}
	}	
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
		<!-- 960 Container -->
		<div class="container">
			<div class="sixteen columns">
				<div class="headline no-margin">
					<h4>فرم ثبت مشخصات</h4>
				</div>
			</div>
			<div class="sixteen columns">
				<div class="mes" id="message">{$msgs}</div>
				<div class="orderform">
					<form action="" method="post" name="frmorder" id="frmorder">
						<div class="field">
							<label>نام و نام خانوادگی <span>*</span></label>
							<input type="text" name="name" class="text" style="float:right;" placeholder="نام و نام خانوادگی">
						</div>
						<div class="clear"></div>
						<div class="field">
							<label>ایمیل <span>*</span></label>
							<input type="text" name="email" class="text ltr" style="float:right;" placeholder="yourname@domain.com">
						</div>
						<div class="clear"></div>
						<div class="field">
							<label>شماره تلفن <span>*</span></label>
							<input type="text" name="tel" class="text ltr" style="float:right;" placeholder="511-6093609">
						</div>
						<div class="clear"></div>
						<div class="field">
							<label>شماره موبایل <span>*</span></label>
							<input type="text" name="mobile" class="text ltr" style="float:right;" placeholder="09154321234">
						</div>
						<div class="clear"></div>
						<div class="field">
							<label>کد ملی <span>*</span></label>
							<input type="text" name="ncode" class="text ltr" style="float:right;" placeholder="0123456789">
						</div>
						<div class="clear"></div>
						<div class="field" style="float:right;direction:rtl">
							<label>درخواست <span>*</span></label>
							<input type="radio" name="otype" value="1" style="width:30px;">ثبت جدید سرویس<br />
							<input type="radio" name="otype" value="2" style="width:30px;">تمدید سرویس<br />
							<input type="radio" name="otype" value="3" style="width:30px;">خرید کالا<br />
							<input type="radio" name="otype" value="4" style="width:30px;">ترافیک اضافه<br />
						</div>
						<div class="clear"></div>
						<div class="field">
							<label>توضیحات (لطفا کد پیگیری دریافتی از بانک و چهار رقم آخر کارتتان را در این قسمت وارد نمایید)<span></span></label>
							<textarea name="body" style="min-width:450px;float:right" class="text textarea"></textarea>
						</div>
						<div class="clear"></div>
						<div class="field">
							<input type="submit" class="button color" style="width:100px;float:right" id="send" value="ارسال درخواست" />
							<input type="hidden" name="mark" value="saveorder" />
						</div>
					</form>
					<div class="clear"></div>
				</div>
			</div>
		</div>	
cd;
	return $html;

?>