<?php
header('Content-Type: text/html; charset=UTF-8');
	include_once("config.php");
	include_once("classes/database.php");
	include_once("classes/functions.php");
	include_once("classes/seo.php");
    $seo = Seo::GetSeo();
	$db = Database::GetDatabase(); 

	$gplus = GetSettingValue('Gplus_Add',0);
	$facebook = GetSettingValue('FaceBook_Add',0);
	$twitter = GetSettingValue('Twitter_Add',0);
	$rss = GetSettingValue('Rss_Add',0);
	$email = GetSettingValue('Contact_Email',0);
	$tel = GetSettingValue('Tell_Number',0);

?>
<!DOCTYPE html>
<!--[if IE 7 ]>
	<html class="ie ie7" lang="fa">
<![endif]-->
<!--[if IE 8 ]>
	<html class="ie ie8" lang="fa">
<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
	<html lang="fa">
<!--<![endif]-->

<head>
<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<meta http-equiv="Content-Language"  content="Fa">
<title><?php echo $seo->Site_Title;?></title>
<meta name="google-site-verification" content="xSLO321Gv9I20zvju1204_ZRb_jX9qBj0LdTFuchM58" />
<meta name="description" content="<?php echo $seo->Site_Describtion;?>"/>
<meta name="keywords" content="<?php echo $seo->Site_KeyWords;?>"/>
<meta name="robots" content="INDEX,FOLLOW">

<!-- Mobile Specific
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" type="text/css" href="themes/css/base.css">
<link rel="stylesheet" type="text/css" href="themes/css/skeleton.css">
<link rel="stylesheet" type="text/css" href="themes/css/fancybox.css">
<link rel="stylesheet" type="text/css" href="themes/css/style.css">
<link rel="stylesheet" type="text/css" href="themes/css/boxed.css" id="layout">
<link rel="stylesheet" type="text/css" href="themes/css/colors/navy.css" id="colors">

<link rel="shortcut icon" href="favicon.ico">
<link rel="apple-touch-icon" href="favicon.ico">

<!-- Java Script
================================================== -->
<script src="themes/js/jquery.min.js"></script>
<script src="themes/js/custom.js"></script>
<script src="themes/js/selectnav.js"></script>
<script src="themes/js/flexslider.js"></script>
<script src="themes/js/twitter.js"></script>
<script src="themes/js/tooltip.js"></script>
<script src="themes/js/effects.js"></script>
<script src="themes/js/fancybox.js"></script>
<script src="themes/js/carousel.js"></script>
<script src="themes/js/isotope.js"></script>
<script src="themes/js/jquery-easing-1.3.js"></script>
<script src="themes/js/jquery-transit-modified.js"></script>
<script src="themes/js/layerslider.transitions.js"></script>
<script src="themes/js/layerslider.kreaturamedia.jquery.js"></script>

</head>
<body>
	<script type="text/javascript" src="lib/js/CFInstall.js"></script>
    <script>
       CFInstall.check({
            url: "ie.html",
            mode: "overlay",
            destination: "http://www.soushiant.co",
       });
    </script>
<!-- Wrapper Start -->
<div id="wrapper">
<!-- Header
================================================== -->
<!-- 960 Container -->
<div class="container ie-dropdown-fix">
	<!-- Header -->
	<div id="header">
		<!-- Logo -->
		<div class="eight columns left">
			<div id="logo">
				<a href="./" title="Soushiant"><img src="themes/images/logo.png" alt="Soushiant"></a>
				<div class="clear"></div>
			</div>
		</div>
		<!-- Social / Contact -->
		<div class="eight columns">	
			<!-- Social Icons -->
			<ul class="social-icons">
				<li class="facebook"><a href="https://<?php echo $facebook; ?>" target="_blank"></a></li>
				<li class="twitter"><a href="https://<?php echo $twitter; ?>" target="_blank"></a></li>
				<li class="googleplus"><a href="https://<?php echo $gplus; ?>" target="_blank"></a></li>
				<li class="rss"><a href="http://<?php echo $rss; ?>" target="_blank"></a></li>
			</ul>		
			<div class="clear"></div>		
			<!-- Contact Details -->
			<div id="contact-details">
				<ul>
					<li class="latin-font ltr"><i class="mini-ico-envelope"></i><?php echo $email ?></li>
					<li class="latin-font ltr"><i class="mini-ico-user"></i><?php echo $tel; ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Header / End -->	
	<!-- Navigation -->
	<div class="sixteen columns">
		<div id="navigation">
			<ul id="nav">
				<li><a href="./">صفحه اصلی</a></li>
				<li><a href="services.html">خدمات</a></li>
				<li><a href="adsl.html">اینترنت پرسرعت</a>
					<!-- <ul>
						<li><a href="portfolio_2.html">2 Columns</a></li>
						<li><a href="portfolio_3.html">3 Columns</a></li>
						<li><a href="portfolio_4.html">4 Columns</a></li>
						<li><a href="single_project.html">Single Project</a></li>
					</ul> -->
				</li>
				<li><a href="product.html">خرید کالا</a></li>
				<li><a href="works.html">پروژه ها</a></li>
				<li><a href="news.html">تازه ها</a></li>
				<li><a href="about-us.html">درباره ما</a></li>
				<li><a href="contact.html">تماس با ما</a></li>
			</ul>
			<!-- Search Form -->
			<div class="search-form">
				<form action="search.html" method="post" name="frmsearch">
					<input type="text" name="searchtxt" id="header-search-input" class="search-text-box" autocomplete="off"/>
					<input type="hidden" name="mark" value="search" />
				</form>
			</div>
		</div> 
		<div class="clear"></div>
	</div>
	<!-- Navigation / End -->
</div>
<!-- 960 Container / End -->