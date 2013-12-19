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
					<h2>خرید کالا</h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container">			
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
						<i class="ico-shopping-cart" style="margin-left: -12px;"></i>
						<h3><a class="price-table" name="{$val[name]}" id="{$val[id]}">{$val["name"]}</a></h3>
						<p>{$val["body"]}</p>
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
					$('.price-table').click(function(){
						var name = $(this).attr("name");
						var id = $(this).attr("id");
						$.ajax({
							type: 'POST',
				    		url: "themes/price.php?comp="+name+"&compid="+id,
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