<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();   
  $services = $db->SelectAll("services","*");    
  $partner= file_get_contents('themes/inc/partner.php');
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
		<div class="container cyan">
			<div class="sixteen columns">
				<div class="headline"><h4>خدمات</h4></div>
			</div>						
cd;
$i = 0;
foreach($services as $key => $val)
{
   ++$i;
   $val["body"]=  strip_tags($val["body"]);
   $val["body"] = (mb_strlen($val["body"])>200) ? mb_substr($val["body"],0,200,"UTF-8")."..." : $val["body"];
   if ($i % 2 != 0)
	$html.="<div class='icon-boxes-container'>  <!-- Icon Box Container -->";
$html.=<<<cd
				<!-- Icon Box Start -->
				<div class="eight columns">
					<div class="icon-box">
						<i class="ico-cogwheel" style="margin-left: -12px;"></i>
						<h3><a href="service-fullpage{$val[id]}.html">{$val["subject"]}</a></h3>
						<p>{$val["body"]}</p>
					</div>
				</div>
				<!-- Icon Box End -->
cd;
	if (($i % 2 == 0) or (count($services)==$i))	  
		$html.="</div>   <!-- Icon Box Container / End -->";
   
}
$html.=<<<cd
 <!--
			<div class="two-thirds column">
				<div class="headline no-margin"><h4 id="service1">خدمت اول</h4></div>
				<div class="three-third column alpha">
					<p>توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... </p>
				</div>
			</div>
			<div class="one-third column">
				<div class="headline no-margin"><h4>ویژگی ها</h4></div>
				<ul class="check_list">
					<li>توضی خدمت... توضی خدمت... توضی خدمت... </li>
					<li>توضی خدمت... توضی خدمت... توضی خدمت... </li>
					<li>توضی خدمت... توضی خدمت... توضی خدمت... </li>
					<li>Compatible with Major Browsers</li>
					<li>Attuned to Smartphones and Tablet PCs</li>
				</ul>
				<p></p>
			</div>
			<div class="two-thirds column">
				<div class="headline no-margin"><h4 id="service1">خدمت دوم</h4></div>
				<div class="three-third column alpha">
					<p>توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... توضی خدمت... </p>
				</div>
			</div>
			<div class="one-third column">
				<div class="headline no-margin"><h4 id="service2">ویژگی ها</h4></div>
				<ul class="check_list">
					<li>توضی خدمت... توضی خدمت... توضی خدمت... </li>
					<li>توضی خدمت... توضی خدمت... توضی خدمت... </li>
					<li>توضی خدمت... توضی خدمت... توضی خدمت... </li>
					<li>Compatible with Major Browsers</li>
					<li>Attuned to Smartphones and Tablet PCs</li>
				</ul>
				<p></p>
			</div>
-->			
		</div>
	{$partner}
cd;
	return $html;

?>