<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();   
  $company = $db->SelectAll("company","*");   
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>ADSL</h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container cyan">			
cd;
$i = 0;
foreach($company as $key => $val)
{
   ++$i;
   $val["body"]=  strip_tags($val["body"]);
   $val["body"] = (mb_strlen($val["body"])>200) ? mb_substr($val["body"],0,200,"UTF-8")."..." : $val["body"];
   if ($i % 2 != 0)	
	$html.="<!-- Icon Box Container --> <div class='icon-boxes-container'> ";
$html.=<<<cd
				<!-- Icon Box Start -->
				<div class="eight columns">
					<div class="icon-box">
						<i class="ico-wifi-alt" style="margin-left: -12px;"></i>
						<h3><a href="adsl-fullpage{$val[id]}.html" class="price-table" name="{$val[name]}" id="{$val[id]}">{$val["name"]}</a></h3>
						<p>{$val["body"]}</p>
					</div>
				</div>
				<!-- Icon Box End -->				
cd;
if (($i % 2 == 0) or (count($company)==$i))	  
		$html.="</div>   <!-- Icon Box Container / End -->";
}
	return $html."</div>";

?>