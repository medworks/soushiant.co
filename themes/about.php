<?php
include_once("./classes/database.php");
$db = Database::GetDatabase(); 
$About_System = GetSettingValue('About_System',0);
$html=<<<cd
	<div class="container">
		<div class="sixteen columns">
			<!-- Page Title -->
			<div id="page-title">
				<h2>درباره ما</h2>
				<div id="bolded-line"></div>
			</div>
			<!-- Page Title / End -->
		</div>
		</div>
		<div class="container">
			<!-- Standard Structure -->
			<div class="two-thirds column">
				<div class="headline no-margin"><h4>درباره ما</h4></div>
				<p>{$About_System} </p>
			</div>
		<!--	
			<div class="one-third column">
				<div class="headline no-margin"><h4>رویکرد ما</h4></div>
				<p>درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... </p>
				<p>درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... درباهر شرکت... </p>
			</div>
		-->	
			<!-- Standard Structure End -->
		</div>
cd;
	return $html;
?>
