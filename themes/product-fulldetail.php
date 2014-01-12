<?php
    include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
	$stuffs = $db->SelectAll("stuff","*","cat = {$_GET[stuffid]}");
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>خرید کالا <span>/ tplink</span></h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container">
			<!-- Slider -->
			<div class="four columns">
				<ul>
					<li><img src="themes/images/logo.png" alt=""></li>						
				 </ul>
			</div>
			<div class="four columns">
					<p>نسبلنمتلت ث هث خهث هثه خث ععهف</p>
								
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$('.order').click(function(){
					//var name = $(this).attr("name");
					//var id = $(this).attr("id");
					$.ajax({
						type: 'POST',
			    		url: "themes/order.php",
			   			// data: $(".price-table").serialize(),
				    		success: function(msg)
							{
								$("#order-form").ajaxComplete(function(event, request, settings){				
									$(this).hide();
									$(this).html(msg).slideDown("slow");
								});
							}

					});
					return false;
				});
			});
		</script>
		<div class="container" style="margin-top:30px;">
			<div class="four columns">
				<a class="button color order" style="text-align:right;float:right;" title="سفارش">سفارش خرید</a>
			</div>
			<div class="clear"></div>
		</div>
		<div class="container" style="margin-top:30px;">
			<div id="order-form"></div>
		</div>		
cd;
	return $html;

?>