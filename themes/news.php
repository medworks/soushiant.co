<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();
  $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
  $maxItemsInPage = GetSettingValue('Max_Post_Number',0);
  $from = ($pageNo - 1) * $maxItemsInPage;
  $count = $maxItemsInPage;
  
  $news = $db->SelectAll("news","*",null,"ndate DESC",$from,$count);  
  $itemsCount = $db->CountAll("news");
     

$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>اخبار</h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container">
			<div class="twelve columns">
cd;
foreach($news as $key => $post)
{
	$ndate = ToJalali($post["ndate"]," l d F  Y ساعت H:m");
  	$post["userid"] = GetUserName($post["userid"]);	
    $post["body"]= strip_tags($post["body"]);
    $post["body"] = (mb_strlen($post["body"])>500) ? mb_substr($post["body"],0,500,"UTF-8")."..." : $post["body"];
$html.=<<<cd
				<!-- Post -->
				<div class="post">
					<div class="post-img picture"><a href="news-fullpage{$post[id]}.html"><img src="{$post[image]}" alt="{$post[subject]}"><div class="image-overlay-link"></div></a></div>
					<a href="news-fullpage{$post[id]}.html" class="post-icon standard"></a>
					<div class="post-content">
						<div class="post-title"><h2><a href="news-fullpage{$post[id]}.html">{$post["subject"]}</a></h2></div>
						<div class="post-meta rtl"><span><i class="mini-ico-calendar"></i>تاریخ: {$ndate}</span> 
						<span><i class="mini-ico-user"></i>به وسیله:  {$post["userid"]}</span> 
						<!-- <span><i class="mini-ico-comment"></i>With <a href="#">12 Comments</a></span> --></div>
						<div class="post-description">
						<p>{$post["body"]}</p>
						</div>
						<a href="news-fullpage{$post[id]}.html" class="button color">ادامه خبر</a>
					</div>
				</div>
				<!-- Post -->
cd;
}
$linkFormat = 'news-page'.$pid='%PN%'.'.html';
$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);
$html .= '<div class="row"><div id="blog-pagination" class="large-12 columns pagination-centered rtl">' . $pageNos . '</div></div>';

$html.=<<<cd
			</div>
			<!-- Widget ================================================== -->
			<div class="four columns">
				<!-- Search -->
				<div class="widget first">
					<div class="headline no-margin"><h4>جستجو</h4></div>
					<div class="search">
						<input type="text" onblur="if(this.value=='')this.value='';" onfocus="if(this.value=='')this.value='';" value="" class="text">
					</div>
				</div>
				<!-- Popular Posts -->
				<div class="widget">
					<div class="headline no-margin"><h4>آخرین اخبار</h4></div>
cd;
$posts = $db->SelectAll("news","*",null,"ndate DESC");
for($i = 0;$i<5;$i++)
{
  if (!isset($posts[$i][id])) break;
	$ndate = ToJalali($posts[$i]["ndate"]," l d F  Y");
$html.=<<<cd
					<div class="latest-post-blog">
						<a href="news-fullpage{$posts[$i][id]}.html"><img src="{$posts[$i][image]}" alt="{$posts[$i][subject]}"></a>
						<p><a href="news-fullpage{$posts[$i][id]}.html">{$posts[$i]["subject"]} </a> <span>{$ndate}</span></p>
					</div>
cd;
}
$html.=<<<cd
				</div>
			</div>
		</div>
cd;
	return $html;

?>
