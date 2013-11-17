<?php

$html=<<<cd
		<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>تماس با ما</h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container">
				<!-- Text -->
				<div class="sixteen columns">
					<p>شما می توانید از طریق راه های ارتباطی زیر با ما در تماس باشید. لطفا نظرات، انتقادات و پیشنهادات خود را برای ما ارسال نمایید.</p>
					<br>
				</div>
				<!-- Contact Form -->
				<div class="twelve columns">
					<div class="headline no-margin"><h4>فرم تماس</h4></div>
					<div class="form-spacer"></div>
					<!-- Success Message -->
					<div class="success-message">
					<div class="notification success closeable">
						<p><span>Success!</span> Your message has been sent.</p>
					</div>
				</div>
				<!-- Form -->
				<div id="contact-form">
					<form method="post" class="rtl" action="contact.php">
						<div class="field">
							<label>نام و نام خانوادگی:</label>
							<input type="text" name="name" class="text">
						</div>
						<div class="field">
							<label>ایمیل: <span>*</span></label>
							<input type="text" name="email" class="text">
						</div>
						<div class="field">
							<label>پیام: <span>*</span></label>
							<textarea name="message" class="text textarea"></textarea>
						</div>
						<div class="field">
							<input type="button" id="send" value="ارسال پیام">
							<div class="loading"></div>
						</div>
					</form>
				</div>
			</div>
			<!-- Contact Details -->
			<div class="four columns google-map">
				<div class="headline no-margin"><h4>مکان ما</h4></div>
				<!-- Google Maps -->
				<div id="googlemaps" class="google-map google-map-full" style="height:250px"></div>
				<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
				<script src="themes/js/jquery.gmap.min.js"></script>
				<script type="text/javascript">
					function initialize()
					{
						var mapProp = {
						  center:new google.maps.LatLng(36.321505, 59.523654),
						  zoom:18,
						  mapTypeId:google.maps.MapTypeId.ROADMAP
						  };

						var map=new google.maps.Map(document.getElementById("googlemaps"),mapProp);

					}

					google.maps.event.addDomListener(window, "load", initialize);
				</script>
			</div>
			<!-- Contact Details -->
			<div class="four columns">
				<div class="headline low-margin"><h4>پیوستن به ما</h4></div>
				<div id="social" class="tooltips">
					<a href="#" rel="tooltip" title="Facebook" class="facebook">Facebook</a>
					<a href="#" rel="tooltip" title="Evernote" class="evernote">Evernote</a>
					<a href="#" rel="tooltip" title="LinkedIn" class="linkedin">LinkedIn</a>
					<a href="#" rel="tooltip" title="Google Plus" class="googleplus">Google Plus</a>
					<a href="#" rel="tooltip" title="Vimeo" class="vimeo">Vimeo</a>
				</div>
			</div>
		</div>
cd;
	return $html;

?>