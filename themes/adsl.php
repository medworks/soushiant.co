<?php

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
		<div class="container">
			<div class="sixteen columns">
				<div class="headline"><h4>شاتل</h4></div>
			</div>
			<!-- Icon Box Container -->
			<div class="icon-boxes-container">
				<!-- Icon Box Start -->
				<div class="eight columns">
					<div class="icon-box">
						<i class="ico-wifi-alt" style="margin-left: -12px;"></i>
						<h3><a class="price-table">شاتل</a></h3>
						<p>توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد شاتل... توضیح در مورد  </p>
					</div>
				</div>
				<!-- Icon Box End -->
				<!-- Icon Box Start -->
				<div class="eight columns">
					<div class="icon-box">
						<i class="ico-wifi-alt"></i>
						<h3><a class="price-table">Social Marketing</a></h3>
						<p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Mauris ut ligula tortorea lorem ipsum dolor sit amet gorbi vel nulla eget quam porttitor gravida.</p>
					</div>
				</div>
				<!-- Icon Box End -->
			</div>
			<!-- Icon Box Container / End -->
			<!-- Icon Box Container -->
			<div class="icon-boxes-container">
				<!-- Icon Box Start -->
				<div class="eight columns">
					<div class="icon-box">
						<i class="ico-wifi-alt" style="margin-left: -10px;"></i>
						<h3>Web Design</h3>
						<p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Mauris ut ligula tortorea lorem ipsum dolor sit amet gorbi vel nulla eget quam porttitor gravida.</p>
					</div>
				</div>
				<!-- Icon Box End -->
				<!-- Icon Box Start -->
				<div class="eight columns">
					<div class="icon-box">
						<i class="ico-wifi-alt"></i>
						<h3>Video Recording</h3>
						<p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt. Mauris ut ligula tortorea lorem ipsum dolor sit amet gorbi vel nulla eget quam porttitor gravida.</p>
					</div>
				</div>
				<!-- Icon Box End -->
			</div>
			<!-- Icon Box Container / End -->
			<script>
				$(document).ready(function(){
					$('.price-table').click(function(){
						$.ajax({
							type: 'POST',
				    		url: "themes/price.php",
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