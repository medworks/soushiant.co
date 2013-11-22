<?php
include_once("./config.php");
include_once("./lib/persiandate.php");
include_once("./classes/database.php");	
include_once("./classes/seo.php");	
$db = Database::GetDatabase();
$seo = Seo::GetSeo();
$service = $db->Select('services',NULL,"id={$_GET[wid]}"," id DESC");
$body = $service['body'];
$seo->Site_Title = $service["subject"];
$seo->Site_Describtion = strip_tags(mb_substr($service["body"],0,150,"UTF-8"));
$html=<<<cd
	<div class="container">
		<div class="sixteen columns">
			<!-- Page Title -->
			<div id="page-title">
				<h2>خدمات</h2>
				<div id="bolded-line"></div>
			</div>
			<!-- Page Title / End -->
		</div>
		</div>
		<div class="container">
			<!-- Standard Structure -->
			<div class="sixteen columns">
				<div class="headline no-margin"><h4>{$service["subject"]}</h4></div>
				<p>{$service["body"]} </p>
			</div>
			<!-- Standard Structure End -->
		</div>
cd;
	return $html;
?>
