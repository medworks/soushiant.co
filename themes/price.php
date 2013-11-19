<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();
  $companyid = $_GET["compid"];
  $companyname = $_GET["comp"];
  $plans = $db->SelectAll("plans","*","sid = {$companyid}");
$html=<<<cd
		<!-- Four Tables ================================================== -->
		<!-- 960 Container -->
		<div class="container">
			<div class="sixteen columns">
				<div class="headline no-margin">
					<h4>{$companyname}</h4>
				</div>
				<!-- Number of Tables / From 2 to 5 / -->
				<div class="four-tables">
					<div class="pricing-table">
						<div class="color-1">
							<h3>ECO 128</h3>
							<h4><span class="price">13,900 ریال</span> <span class="time">یک ماهه</span></h4>
							<ul>
								<li>سرعت دریافت 128 Kb/S</li>
								<li>سرعت ارسال 128 Kb/S</li>
								<li>ترافیک 3 GB</li>
								<li>هزینه در ماه 13,900 ریال</li>
								<li>هزینه اشتراک 13,900 ریال</li>
							</ul>
							<a href="#" class="sign-up"><span>پرداخت هزینه</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
cd;
	echo $html;

?>