<?php
	include_once("./classes/database.php");
	include_once("./lib/persiandate.php");
	$db = Database::GetDatabase(); 
	$About_System = GetSettingValue('About_System',0);
	$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
	$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
	$articles = $db->SelectAll('articles',NULL,NULL," ndate DESC");
	$About_System = mb_substr(html_entity_decode(strip_tags($About_System), ENT_QUOTES, "UTF-8"), 0, 500,"UTF-8")."  ...";
	$address = GetSettingValue('Address',0);
	$tel = GetSettingValue('Tell_Number',0);
	$fax = GetSettingValue('Fax_Number',0);
	$email = GetSettingValue('Contact_Email',0);
	
?>
</div>
<!-- Footer
================================================== -->
<!-- Footer Start -->
<div id="footer">
	<!-- 960 Container -->
	<div class="container">
		<!-- About -->
		<div class="one-third column">
			<div class="footer-headline"><h4>همکاران</h4></div>
			<ul class="links-list rtl">
				<li><a href="http://10.70.246.75:88/Pages/Login.aspx?ReturnUrl=%2fMemberPages%2f" target="_blank" title="اینترنت مخابرات">شرکت مخابرات خراسان رضوی</a></li>
				<li><a href="http://80.191.241.124/login.aspx" target="_blank" title="شرکت شاتل">شرکت شاتل</a></li>
				<li><a href="http://qt.asiatech.ir/" target="_blank" title="شرکت آسیاتک">شرکت آسیاتک</a></li>
				<li><a href="" target="_blank" title="شرکت مبین نت">شرکت مبین نت</a></li>
				<li><a href="" target="_blank" title="پنل ارسال اس ام اس">پنل ارسال اس ام اس</a></li>
			</ul>
		</div>	
		<!-- Useful Links -->
		<div class="one-third column">
			<div class="footer-headline"><h4>تازه ها</h4></div>
			<ul class="links-list rtl">
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
		<div class="one-third column">
			<div class="footer-headline"><h4>سایت های مفید</h4></div>
			<ul class="links-list rtl">
				<li><a href="https://ib.agri-bank.com/pid2.lmx" target="_blank" title="بانک کشاورزی">بانک کشاورزی</a></li>
				<li><a href="https://ebanking.bankmellat.ir/ebanking/" target="_blank" title="بانک ملت">بانک ملت</a></li>
				<li><a href="https://www.rb24.ir/login.html" target="_blank" title="بانک رفاه">بانک رفاه</a></li>
				<li><a href="https://ebank.bmi.ir/mbsweb/bankmelli/login.aspx" target="_blank" title="بانک ملی">بانک ملی</a></li>
			</ul>
		</div>		
		<!-- Latest Tweets 
		<div class="four columns">
			<div class="footer-headline"><h4>ارتباط با ما</h4></div>
			<ul class="links-list rtl contact">
				<li class="latin-font"><i class="mini-ico-road"></i><p style="display:inline;"><?php echo $address; ?></p></li>
				<li class="latin-font"><i class="mini-ico-envelope"></i><?php echo $email ?></li>
				<li class="latin-font"><i class="mini-ico-user"></i><p class="latin-font ltr" style="text-align:left;"><?php echo $tel; ?></p></li>
				<li class="latin-font"><i class="mini-ico-print"></i><p class="latin-font ltr" style="text-align:left;"><?php echo $fax; ?></p></li>
			</ul>
		</div> -->
		<!-- <div class="four columns">
			<div class="footer-headline"><h4>اشتراک خبرنامه</h4></div>
			<form id="subscribfrm" method="post" action="">
				<p><input type="text" name="name" class="subscrib" id="subscrib" placeholder="نام و نام خانوادگی"></p>
				<p><input type="text" name="tel" class="subscrib" id="subscrib" placeholder="تلفن همراه"></p>
				<p><input type="text" name="email" class="subscrib ltr" id="subscrib" placeholder="E-mail"></p>
				<p><input type="submit" class="submit" id="nsubmit" value="اشتراک"></p>
				<fieldset class="info_fieldset">
					<div id="note"></div>
				</fieldset>
				<input type="hidden" name="mark" value="regnews">
			</form>
		</div> -->
		<!-- Footer / Bottom -->
		<div class="sixteen columns">
			<div id="footer-bottom" class="latin-font">
				© Copyright 2013 by <a href="./">Soushiant</a>. All rights reserved.<br />
				Designed by <a href="http://www.mediateq.ir" target="_blank">Mediateq</a>
				<div id="scroll-top-top"><a href="#"></a></div>
			</div>
		</div>
	</div>
	<!-- 960 Container / End -->
</div>
<!-- Footer / End -->
</body></html>