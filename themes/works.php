<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();   
  $works = $db->SelectAll("works","*",null,"fdate DESC");
  foreach($works as $key=>$val) $cats[] = $val["catid"];    
  $uniqcats = array_unique($cats);
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>پروژه ها</h2>
					<!-- Filters -->
					<div id="filters">
						<ul class="option-set" data-option-key="filter">
							<li><a href="#filter" class="selected" data-option-value="*">همه موارد</a></li>
							<li><a href="#filter" data-option-value=".1">پروژه های داخلی</a></li>
							<li><a href="#filter" data-option-value=".2">پروژه های خارجی</a></li>
						</ul>
					</div>
					<div class="clear"></div>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container">
		<!-- Portfolio Content -->
			<div id="portfolio-wrapper">
cd;
foreach($works as $key=>$val)
{
$val["body"] = mb_substr(html_entity_decode(strip_tags($val["body"]), ENT_QUOTES, "UTF-8"), 0, 150,"UTF-8")."  ...";
$html.=<<<cd
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item {$val[catid]}">
					<div class="picture">
					  <a href="work-fullpage{$val[id]}.html">
						 <img src="{$val[image]}" alt="{$val[subject]}">
						 <div class="image-overlay-link"></div>
					  </a>
					</div>
					<div class="item-description alt">
						<h5><a href="work-fullpage{$val[id]}.html">{$val["subject"]}</a></h5>
						<p>{$val["body"]}</p>
					</div>
				</div>
cd;
}
$html.=<<<cd
			</div>
			<!-- End Portfolio Content -->
		</div>
cd;
	return $html;

?>