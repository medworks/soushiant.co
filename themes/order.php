<?php
    include_once("../config.php");
	include_once("../lib/persiandate.php");
	include_once("../classes/database.php");	
	include_once("../classes/seo.php");	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>خرید کالا <span>/ tplink</span></h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container">
			<!-- Slider -->
			<div class="four columns">
				<ul>
					<li><img src="themes/images/logo.png" alt=""></li>						
				 </ul>
			</div>
			<div class="four columns">
					<p>نسبلنمتلت ث هث خهث هثه خث ععهف</p>
								
			</div>
		</div>
		<div class="container" style="margin-top:30px;">
			<div class="four columns">
				<a href="themes/order.php" class="button color" style="text-align:right;float:right;" title="سفارش">سفارش خرید</a>
			</div>
			<div class="clear"></div>
		</div>		
cd;
	echo $html;

?>