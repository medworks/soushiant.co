<?php
header('Content-Type: text/html; charset=UTF-8');

  include_once("../config.php");
  include_once("../classes/database.php");  
  $db = Database::GetDatabase();  
  $stuffs = $db->SelectAll("stuff","*","cat = {$_GET[stuffid]}");

 	foreach($stuffs as $key=>$val){
$html=<<<cd
		<!-- 960 Container -->
		<div class="container">
			<div class="sixteen columns">
				<div class="headline no-margin">
					<h4>{$_GET["name"]}</h4>
				</div>
			</div>
		<div>
		<div class="container">
			<!-- Portfolio Content -->
			<div id="portfolio-wrapper">
				<div class="four columns portfolio-item">
					<div class="picture">
					  <a href="product-fulldetail153.html">
						 <img src="{$val[image]}" alt="{$val[subject]}">
						 <div class="image-overlay-link"></div>
					  </a>
					</div>
					<div class="item-description">
						<h5><a href="work-fullpage{$val[id]}.html">{$val["subject"]}</a></h5>
					</div>
				</div>
			</div>
			<!-- End Portfolio Content -->
		</div>
cd;
	}

	echo $html;

?>