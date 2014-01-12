<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();   
  $stuffsec = $db->Select("stuffsec","secname","ID = {$_GET[pid]}");
  $stuffcats = $db->SelectAll("stuffcat","*","secid = {$_GET[pid]}");
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>خرید کالا / {$stuffsec[0]}</h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container cyan">			
cd;
$i = 0;
foreach($stuffcats as $key => $val)
{
   ++$i;
   $val["describe"] =  strip_tags($val["describe"]);
   $val["describe"] = (mb_strlen($val["describe"])>200) ? mb_substr($val["describe"],0,200,"UTF-8")."..." : $val["describe"];
   if ($i % 2 != 0)	
	$html.="<!-- Icon Box Container --> <div class='icon-boxes-container'> ";
$html.=<<<cd
				<!-- Icon Box Start -->
				<div class="eight columns">
					<div class="icon-box">
						<i class="ico-shopping-cart" style="margin-left: -12px;"></i>
						<h3><a class="product" name="{$val[catname]}" id="{$val[id]}">{$val["catname"]}</a></h3>
						<p>{$val["describe"]}</p>
					</div>
				</div>
				<!-- Icon Box End -->
cd;
if (($i % 2 == 0) or (count($company)==$i))	  
		$html.="</div>   <!-- Icon Box Container / End -->";
   
}
$html.=<<<cd
			<script>
				$(document).ready(function(){
					$('.product').click(function(){
						var name = $(this).attr("name");
						var id = $(this).attr("id");
						$.ajax({
							type: 'POST',
				    		url: "themes/product-detail.php?comp="+name+"&compid="+id,
				   			// data: $(".price-table").serialize(),
					    		success: function(msg)
								{
									$("#product").ajaxComplete(function(event, request, settings){				
										$(this).hide();
										$(this).html(msg).slideDown("slow");
									});
								}

						});
						return false;
					});
				});
			</script>
		</div>
		<div id="product"></div>
cd;
	return $html;

?>