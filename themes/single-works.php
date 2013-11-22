<?php
    include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
 	$work = $db->Select('works',NULL,"id={$_GET[wid]}");	
	$sdate = ToJalali($work["sdate"]," l d F  Y ");
	$fdate = ToJalali($work["fdate"]," l d F  Y ");	
	$seo->Site_Title = $work["subject"];
	$seo->Site_Describtion = strip_tags(mb_substr($work["body"],0,150,"UTF-8"));
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>پروژه ها <span>/ {$work["subject"]}</span></h2>
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
			<div class="twelve columns tooltips">
				<div class="twelve columns alpha"><p>{$work["body"]} </p></div>
			</div>
			<div class="four columns">
				<ul class="project-info">
					<li><strong>مشتری:</strong> </li>
					<li><strong>تاریخ:</strong> {$fdate}</li>
				</ul>				
			</div>
		</div>		
cd;
	return $html;

?>