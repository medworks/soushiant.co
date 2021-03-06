<?php
  include_once("./classes/database.php");
  include_once("./classes/functions.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();   
  $gplans = $db->SelectAll("plangroups","*","compid = '{$_GET[wid]}'");
  $compname = GetCompanyName($_GET["wid"]); 
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>ADSL / {$compname}</h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container cyan">			
cd;
$i = 0;
foreach($gplans as $key => $val)
{
   ++$i;      
   if ($i % 2 != 0)	
	$html.="<!-- Icon Box Container --> <div class='icon-boxes-container'> ";
$html.=<<<cd
				<!-- Icon Box Start -->
				<div class="eight columns">
					<div class="icon-box">
						<i class="ico-wifi-alt" style="margin-left: -12px;"></i>
						<h3><a class="price-table" name="{$val[subject]}" id="{$val[id]}">{$val["subject"]}</a></h3>						
					</div>
				</div>
				<!-- Icon Box End -->
cd;
if (($i % 2 == 0) or (count($gplans)==$i))	  
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
									$("#price").ajaxComplete(function(event, request, settings){				
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
		<div id="price"></div>
cd;
	return $html;

?>