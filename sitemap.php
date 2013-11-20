<?php
    include_once("./config.php");
    include_once("./classes/database.php");	
	include_once("./classes/functions.php");
	
	$db = Database::GetDatabase();
	header("Content-Type: application/xml; charset=utf-8");
    $sm = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
	$news = $db->SelectAll("news","*",null,"id ASC");
	$works = $db->SelectAll("works","*",null,"id ASC");	
	$add ="http://www.soushiant.co/" ;

	$sm .="
	<url>
	  <loc>http://www.soushiant.co/</loc>
	</url>
	<url>
	  <loc>http://www.soushiant.co/search.html</loc>
	</url>
	<url>
	  <loc>http://www.soushiant.co/about-us.html</loc>
	</url>
	<url>
	  <loc>http://www.soushiant.co/works.html</loc>
	</url>
	<url>
	  <loc>http://www.soushiant.co/news.html</loc>
	</url>
	<url>
	  <loc>http://www.soushiant.co/articles.html</loc>
	</url>
	<url>
	  <loc>http://www.soushiant.co/contact.html</loc>
	</url>
	<url>
	  <loc>http://www.soushiant.co/gallery.html</loc>
	</url>
";
	$date = date("Y-m-d");	

	foreach($news as $key=>$val)
	{
		//$date = date("Y-m-dTH:i:s+00:00",$val['ndate']);
		//$date = date("D, d M Y H:i:s T");
		$sm.=<<<cd
		<url>
			<loc>{$add}news-fullpage{$val["id"]}.html</loc>
			<lastmod>{$date}</lastmod>
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
        </url>    		
cd;
	}
	foreach($works as $key=>$val)
	{
	   //$date = date("D, d M Y H:i:s T",$val['sdate']);
	   //$date = date("D, d M Y H:i:s T");
		$sm.=<<<cd
		<url>
			<loc>{$add}works-fullpage{$val["id"]}.html</loc>
			<lastmod>{$date}</lastmod>
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
        </url>    		
cd;
	}	
    $sm.= "</urlset>";
	echo $sm;