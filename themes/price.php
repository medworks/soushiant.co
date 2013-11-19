<?php
  include_once("../config.php");
  include_once("../classes/database.php");  
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
cd;
$i = 0;
foreach($plans as $key => $val)
{
   ++$i;
   $totalprice = $val["price"]*$val["time"];
$html.=<<<cd
					<div class="pricing-table">
						<div class="color-1">
							<h3>{$val["name"]}</h3>
							<h4><span class="price">{$totalprice}</span> 
							<span class="time">{$val["time"]}</span></h4>
							<ul>
								<li>سرعت دریافت {$val["speeddl"]} KB/S</li>
								<li>سرعت ارسال {$val["speedup"]} KB/S</li>
								<li>ترافیک {$val["trafic"]} GB</li>
								<li>هزینه در ماه {$val["price"]} ریال</li>			
							</ul>
							<a href="#" class="sign-up"><span>پرداخت هزینه</span></a>
						</div>
					</div>
cd;
}
$html.=<<<cd
				</div>
			</div>
		</div>
cd;
	echo $html;

?>