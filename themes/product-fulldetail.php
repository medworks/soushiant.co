<?php
    include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
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
			<div class="sixteen columns">
				<div class="flexslider home">
					<ul class="slides">
						<li><img src="{$work[image]}" alt="{$work[subject]}"></li>						
					 </ul>
				</div>
			</div>
		</div>
		<div class="container" style="margin-top: 30px;">
			<div class="sixteen columns tooltips">
				<div class="sixteen columns alpha"><p>{$work["body"]} </p></div>
			</div>
		</div>		
cd;
	return $html;

?>