<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();   
  $stuffsec = $db->SelectAll("stuffsec","*");   
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>خرید کالا</h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container cyan">			
cd;
$i = 0;
foreach($stuffsec as $key => $val)
{
   ++$i;
   $val["describe"]=  strip_tags($val["describe"]);
   $val["describe"] = (mb_strlen($val["describe"])>200) ? mb_substr($val["describe"],0,200,"UTF-8")."..." : $val["describe"];
   if ($i % 2 != 0)	
	$html.="<!-- Icon Box Container --> <div class='icon-boxes-container'> ";
$html.=<<<cd
				<!-- Icon Box Start -->
				<div class="eight columns">
					<div class="icon-box">
						<i class="ico-shopping-cart" style="margin-left: -12px;"></i>
						<h3><a href="product-fullpage{$val[id]}.html" name="{$val[secname]}" id="{$val[id]}">{$val["secname"]}</a></h3>
						<p>{$val["describe"]}</p>
					</div>
				</div>
				<!-- Icon Box End -->
cd;
if (($i % 2 == 0) or (count($stuffsec)==$i))	  
		$html.="</div>   <!-- Icon Box Container / End -->";
   
}
$html.=<<<cd
		</div>
cd;
	return $html;

?>