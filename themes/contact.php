<?php
	include_once("config.php");
	include_once("classes/database.php");
	include_once("classes/functions.php");
	$db = Database::GetDatabase();

	$gplus = GetSettingValue('Gplus_Add',0);
	$facebook = GetSettingValue('FaceBook_Add',0);
	$twitter = GetSettingValue('Twitter_Add',0);
	$rss = GetSettingValue('Rss_Add',0);

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
				<script>
                    $(document).ready(function(){
                        $("#contact-frm").submit(function(){
                            $.ajax({
                                type: "POST",
                                url: "manager/ajaxcommand.php?contact=reg",
                                data: $("#contact-frm").serialize(),
                                    success: function(msg)
                                    {
                                        $("#note-contact").ajaxComplete(function(event, request, settings){             
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
				<div id="contact-form">
					<form id="contact-frm" method="post" class="rtl">
						<div class="field">
							<label>نام و نام خانوادگی <span>*</span></label>
							<input type="text" name="name" class="text">
						</div>
						<div class="field">
							<label>ایمیل <span>*</span></label>
							<input type="text" name="email" class="text ltr">
						</div>
						<div class="field">
							<label>موضوع <span>*</span></label>
							<input type="text" name="subject" class="text">
						</div>
						<div class="field">
							<label>پیام <span>*</span></label>
							<textarea name="message" class="text textarea"></textarea>
						</div>
						<div class="field">
							<input type="submit" class="button color" style="width:100px;float:right" id="send" value="ارسال پیام">
						</div>
					</form>
					<div id="note-contact" style="padding-top:10px;margin-right:120px;font-size:18px;"></div>
					<div class="clear"></div>
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
						  center:new google.maps.LatLng(36.320872, 59.525607),
						  zoom:17,
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
					<a href="https://{$facebook}" rel="tooltip" title="Facebook" class="facebook" target="_blank">Facebook</a>
					<a href="https://{$twitter}" rel="tooltip" class="twitter" data-original-title="Twitter" target="_blank">Twitter</a>
					<a href="https://{$gplus}" rel="tooltip" title="Google Plus" class="googleplus" target="_blank">Google Plus</a>
					<a href="http://{$rss}" rel="tooltip" class="rss" data-original-title="RSS" target="_blank">RSS</a>
				</div>
			</div>
		</div>
cd;
	return $html;

?>