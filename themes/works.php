<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();   
  $works = $db->SelectAll("works","*",null,"fdate DESC");
  foreach($works as $key=>$val) $cats[] = $val["catid"];    
  $uniqcats = array_unique($cats);
$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>پروژه ها</h2>
					<!-- Filters -->
					<div id="filters">
						<ul class="option-set" data-option-key="filter">
							<li><a href="#filter" class="selected" data-option-value="*">همه موارد</a></li>
							<li><a href="#filter" data-option-value=".1">پروژه های داخلی</a></li>
							<li><a href="#filter" data-option-value=".2">پروژه های خارجی</a></li>
						</ul>
					</div>
					<div class="clear"></div>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container">
		<!-- Portfolio Content -->
			<div id="portfolio-wrapper">
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 1">
					<div class="picture"><a href="project-fullpage1.html"><img src="themes/images/demo/portoflio-02.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="#">سربرگ یک</a></h5>
						<p>توضیح سربرگ اول.. توضیح سربرگ اول.. توضیح سربرگ اول.. توضیح سربرگ اول.. توضیح سربرگ اول.. توضیح سربرگ اول.. </p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 2">
					<div class="picture"><a href="images/portfolio/portoflio-01-large.jpg" rel="image" title="Maritime Details"><img src="themes/images/demo/portoflio-01.jpg" alt=""><div class="image-overlay-zoom"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Maritime Details</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 1">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-03.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Pine Tree Near Water</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 2">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-04.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Seeds to the Earth</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 2 1">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-05.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Good Idea</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 2">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-06.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Blueberries</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 2 1">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-07.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Touch Gestures</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 1 2">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-08.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Coffee Time</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 1 2">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-09.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Wireless Keyboard</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 2 1">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-10.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Surfing The Web</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item 2">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-11.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Rocks and Sky</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
				<!-- 1/4 Column -->
				<div class="four columns portfolio-item  2">
					<div class="picture"><a href="single_project.html"><img src="themes/images/demo/portoflio-12.jpg" alt=""><div class="image-overlay-link"></div></a></div>
					<div class="item-description alt">
						<h5><a href="single_project.html">Copywriting</a></h5>
						<p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit</p>
					</div>
				</div>
			</div>
			<!-- End Portfolio Content -->
		</div>
cd;
	return $html;

?>