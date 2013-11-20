<?php
include_once("./classes/database.php");
$db = Database::GetDatabase(); 
$About_System = GetSettingValue('About_System',0);
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
				<div class="headline no-margin"><h4>سرویس یک</h4></div>
				<p>بلتبتلاتنلانلتنلا </نp>
			</div>
			<!-- Standard Structure End -->
		</div>
cd;
	return $html;
?>
