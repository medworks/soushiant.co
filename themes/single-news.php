<?php
	include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
 	$news = $db->Select('news',NULL,"id={$_GET[wid]}"," ndate DESC");
	$ndate = ToJalali($news["ndate"]," l d F  Y ");
	$news["userid"] = GetUserName($news["userid"]);
	$body = $news['body'];
	$seo->Site_Title = $news["subject"];
	$seo->Site_Describtion = strip_tags(mb_substr($news["body"],0,150,"UTF-8"));
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>اخبار <span>/ {$news["subject"]}</span></h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->

			</div>
		</div>
		<div class="container">
			<div class="twelve columns">
				<!-- Post -->
				<div class="post">
					<div class="post-img picture"><a href="news.html">
					<img src="{$news[image]}" alt="{$news[subject]}"><div class="image-overlay-link"></div></a></div>
					<a href="#" class="post-icon standard"></a>
					<div class="post-content">
						<div class="post-title"><h2>
						<a href="#">{$news["subject"]}</a></h2></div>
						<div class="post-meta rtl"><span><i class="mini-ico-calendar"></i>تاریخ: {$ndate}</span> <span><i class="mini-ico-user"></i>
						به وسیله: {$news["userid"]}</span> 
						<!-- <span><i class="mini-ico-comment"></i>With <a href="#">12 Comments</a></span> --></div>
						<div class="post-description">
							<p>{$news["body"]}</p>
						</div>						
					</div>
				</div>
			</div>
			<!-- Widget ================================================== -->
			<div class="four columns">
				<!-- Search -->
				<div class="widget first">
					<div class="headline no-margin">
					<h4>جستجو</h4></div>
					<form id="frmsearch" method="post" action="">
						<div class="search">
							<input type="text" id="findtxt" name="findtxt" onblur="if(this.value=='')this.value='';" onfocus="if(this.value=='')this.value='';" value="" class="text">
						</div>
					</form>
					<fieldset class="info_fieldset">
                            <div id="srhresult"></div>
                    </fieldset>
				</div>
				<script type='text/javascript'>
                                $(document).ready(function(){
                                    $("#frmsearch").submit(function(){
                                        $.ajax({                                        
                                            type: "POST",
                                            url: "manager/ajaxcommand.php?items=search&cat=news",
                                            data: $("#frmsearch").serialize(), 
                                            success: function(msg)
                                            {
                                                $('.info_fieldset').css('display','block');
                                                $("#srhresult").ajaxComplete(function(event, request, settings){
                                                    $(this).hide();
                                                    $(this).html(msg).slideDown("slow");
                                                    $(this).html(msg);
                                                });
                                            }
                                        });
                                        return false;
                                    });
                                });
                            </script>
				<!-- Popular Posts -->
				<div class="widget">
				<div class="headline no-margin"><h4>آخرین اخبار</h4></div>
cd;
$news = $db->SelectAll("news","*",null,"ndate DESC");
for($i = 0;$i<7;$i++)
{
  if (!isset($news[$i][id])) break;
	$ndate = ToJalali($news[$i]["ndate"]," l d F  Y");
$html.=<<<cd
					
					<div class="latest-post-blog">
						<a href="news-fullpage{$news[$i][id]}.html">
						<img src="{$news[$i][image]}" alt="{$news[$i][subject]}"></a>
						<p><a href="news-fullpage{$news[$i][id]}.html">
						{$news[$i]["subject"]} </a> <span>{$ndate}</span></p>
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