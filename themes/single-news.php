<?php

$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>اخبار <span>/ خبر یک</span></h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->

			</div>
		</div>
		<div class="container">
			<div class="twelve columns">
				<!-- Post -->
				<div class="post">
					<div class="post-img picture"><a href="blog_post.html"><img src="themes/images/demo/blog-img-01.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<a href="#" class="post-icon standard"></a>
					<div class="post-content">
						<div class="post-title"><h2><a href="single-news.html">خبر اول</a></h2></div>
						<div class="post-meta rtl"><span><i class="mini-ico-calendar"></i>تاریخ: 1392/12/11</span> <span><i class="mini-ico-user"></i>به وسیله: مجتبی امجدی</span> <!-- <span><i class="mini-ico-comment"></i>With <a href="#">12 Comments</a></span> --></div>
						<div class="post-description">
							<p>شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... شرح توضیحات... </p>
						</div>
						<a href="#" class="button color">ادامه خبر</a>
					</div>
				</div>
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
					<div class="latest-post-blog">
						<a href="#"><img src="themes/images/demo/popular-post-01.png" alt=""></a>
						<p><a href="#">سربرگ... سربرگ... سربرگ... سربرگ... </a> <span>12 August 2012</span></p>
					</div>
					<div class="latest-post-blog">
						<a href="#"><img src="themes/images/demo/popular-post-02.png" alt=""></a>
						<p><a href="#">Tetus lorem maecenas facili lipsum pretium.</a> <span>26 July 2012</span></p>
					</div>
					<div class="latest-post-blog">
						<a href="#"><img src="themes/images/demo/popular-post-03.png" alt=""></a>
						<p><a href="#">Lorem pretium metusnula lorem ipsum dolor.</a> <span>16 June 2012</span></p>
					</div>
				</div>
			</div>
		</div>
cd;
	return $html;

?>