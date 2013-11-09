<?php
    include_once("config.php");
    include_once("classes/functions.php");
    include_once("classes/seo.php");
    $seo = Seo::GetSeo(); 

    if (GetPageName($_GET['item'],$_GET['act'])){
        echo include_once GetPageName($_GET['item'],$_GET['act']);
    }else{
        include_once("./classes/database.php");
        include_once("./lib/persiandate.php");
        $db = database::GetDatabase();  

$html=<<<cd
	<!-- Content
	================================================== -->
	<!-- LayerSlider Container -->
	<div class="layerslider-container">
		<!-- LayerSlider / Start -->
		<div id="layerslider" style="width: 940px; height: 400px; margin: 0 auto;"> 
				<!-- Slide #1 -->
				<div class="ls-layer" style="transition2d: 67; timeshift: -1000; slidedelay: 7000;">	 
					<!-- Background -->
					<img class="ls-bg" src="themes/images/demo/slider-img-01.jpg" alt="">
					<div class="slide-caption ls-s1" style="left: 20px; top: 228px; width: 30%; slidedirection: bottom; slideoutdirection: bottom; durationin: 800; durationout: 800; delayin: 0; delayout: 0;">
						<h3>سربرگ</h3>
						<p>توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... </p>
					</div>
				</div>
				<!-- Slide #2 -->
				<div class="ls-layer" style="transition2d: 3; timeshift: -500; slidedelay: 7000;">
					<!-- Background -->
					<img class="ls-bg" src="themes/images/demo/slider-img-02.jpg" alt="">	
					<div class="slide-caption alt ls-s1" style="left: 0; top: 0; height: 100%; width: 30%; slidedirection: left; slideoutdirection: left; durationin: 800; durationout: 800; delayin: 0; delayout: 0;">
						<h3>سربرگ</h3>
						<p>توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... </p>
					</div>
				</div>
				<!-- Slide #3 -->
				<div class="ls-layer" style="transition2d: 5; slidedelay: 7000;">
					<!-- Background -->
					<img class="ls-bg" src="themes/images/demo/slider-img-03.jpg" alt="">
				</div>
		</div>
		<!-- LayerSlider / End -->
	</div>
	<!-- LayerSlider Container / End -->
	<!-- 960 Container -->
	<div class="container">
		<!-- Icon Boxes -->
		<div class="icon-box-container">
			<!-- Icon Box Start -->
			<div class="one-third column">
				<div class="icon-box">
					<i class="ico-bookmark" style="margin-left: -10px;"></i>
					<h3>سربرگ</h3>
					<p>توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... </p>
				</div>
			</div>
			<!-- Icon Box End -->
			<!-- Icon Box Start -->
			<div class="one-third column">
				<div class="icon-box">
					<i class="ico-bookmark"></i>
					<h3>Easily Customization</h3>
					<p>Nam aliquam volutpat leo vel bibendum nunc elit purus, tempus pulvinare rhoncus egestas nibh volutpat leo.</p>
				</div>
			</div>
			<!-- Icon Box End -->
			<!-- Icon Box Start -->
			<div class="one-third column">
				<div class="icon-box">
					<i class="ico-bookmark"></i>
					<h3>Fully Responsive</h3>
					<p>Fusce porttitor turpis quis molestie costant equat. Nam purus, tincidunt sedeat dapibus ugravida ut dui. Fusce et magna libero.</p>
				</div>
			</div>
			<!-- Icon Box End -->		
		</div>
		<!-- Icon Boxes / End -->
	</div>
	<!-- 960 Container / End -->
	<!-- 960 Container -->
	<div class="container">
		<div class="sixteen columns">
			<!-- Headline -->
			<div class="headline no-margin"><h3>کارهای اخیر</h3></div>
		</div>
		<!-- Project -->
		<div class="four columns">
			<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-09.jpg" alt=""><div class="image-overlay-link"></div></a></div>
			<div class="item-description">
				<h5><a href="#">سربرگ اول</a></h5>
				<p>توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... توضیحات سربرگ... </p>
			</div>
		</div>	
		<!-- Project -->
		<div class="four columns">
			<div class="picture"><a href="themes/images/demo/portoflio-08-large.jpg" rel="image" title="Coffee Time"><img src="themes/images/demo/portoflio-08.jpg" alt=""><div class="image-overlay-zoom"></div></a></div>
			<div class="item-description">
				<h5><a href="#">Coffee Time</a></h5>
				<p>Amet sit lorem ligula est, eget conseact etur lectus hendrerit suscipit maecenas.</p>
			</div>
		</div>
		<!-- Project -->
		<div class="four columns">
			<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-10.jpg" alt=""><div class="image-overlay-link"></div></a></div>
			<div class="item-description">
				<h5><a href="#">Surfing The Web</a></h5>
				<p>Lorem sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit.</p>
			</div>
		</div>
		<!-- Project -->
		<div class="four columns">
			<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-07.jpg" alt=""><div class="image-overlay-link"></div></a></div>
			<div class="item-description">
				<h5><a href="#">Wireless Keyboard</a></h5>
				<p>Ligula mauris sit amet est eget consat etur lectus maecenas hendrerit suscipit.</p>
			</div>
		</div>
	</div>
	<!-- 960 Container / End -->
cd;
    echo $html;
    include_once('partner.php');
    }
?>