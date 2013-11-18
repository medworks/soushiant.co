<?php
	include_once("./classes/database.php");
	include_once("./lib/persiandate.php");
	$db = Database::GetDatabase(); 
	$About_System = GetSettingValue('About_System',0);
	$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
	$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
	$articles = $db->SelectAll('articles',NULL,NULL," ndate DESC");
	$About_System = mb_substr(html_entity_decode(strip_tags($About_System), ENT_QUOTES, "UTF-8"), 0, 500,"UTF-8")."  ...";
?>
</div>
<!-- Footer
================================================== -->
<!-- Footer Start -->
<div id="footer">
	<!-- 960 Container -->
	<div class="container">
		<!-- About -->
		<div class="four columns">
			<div class="footer-headline"><h4>درباره ما</h4></div>
			<p><?php echo $About_System ?></p>
		</div>	
		<!-- Useful Links -->
		<div class="four columns">
			<div class="footer-headline"><h4>اخبار</h4></div>
			<ul class="links-list">
				<?php									  					
					for($i=0 ; $i<5 ; $i++){
						if($news[$i]['subject']!=null){
	  						$ndate = ToJalali($news[$i]["ndate"]," l d F ");
							echo "<li>
									<a href='news-fullpage{$news[$i][id]}.html' title='{$news[$i]["subject"]}'>{$news[$i]["subject"]}</a>
								 </li>";
					}}
				?>
			</ul>
		</div>	
		<!-- Photo Stream -->
		<div class="four columns">
			<div class="footer-headline"><h4>کارهای ما</h4></div>
			<ul class="links-list">
				<?Php
                        for($i=0 ; $i<5 ; $i++){
        					if($works[$i]['subject']!=null){						
        						$fdate = ToJalali($works[$i]["fdate"]," l d F  Y"); 
        						echo "<li>
        								<a href='work-fullpage{$works[$i][id]}.html' title='{$works[$i]["subject"]}'>{$works[$i]["subject"]}</a>
        							</li>";
        				    }
        				}
    				?>
			</ul>
		</div>		
		<!-- Latest Tweets -->
		<div class="four columns">
			<div class="footer-headline"><h4>اشتراک خبرنامه</h4></div>
		</div>
		<!-- Footer / Bottom -->
		<div class="sixteen columns">
			<div id="footer-bottom" class="latin-font">
				© Copyright 2013 by <a href="./">Soushiant</a>. All rights reserved.
				<div id="scroll-top-top"><a href="#"></a></div>
			</div>
		</div>
	</div>
	<!-- 960 Container / End -->
</div>
<!-- Footer / End -->
</body></html>