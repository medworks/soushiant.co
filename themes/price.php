<?php
header('Content-Type: text/html; charset=UTF-8');

  include_once("../config.php");
  include_once("../classes/database.php");  
  $db = Database::GetDatabase();
  $companyid = $_GET["compid"];
  $companyname = $_GET["comp"];
  $plans = $db->SelectAll("plans","*","sid = {$companyid}","pos ASC");
  $trafic = $db->SelectAll("trafic","*","pid = {$companyid}","id ASC");
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
$j = 0;
foreach($plans as $key => $val)
{
   ++$i;
   ++$j; 
   $totalprice = $val["price"]*$val["time"];   
   
if ($i % 2 != 0)	
	$html.="<div class='pricing-table'> <div class='color-1'>";
else	
    $html.="<div class='pricing-table'> <div class='color-2'>";	
						
$html.=<<<cd
							<h3>{$val["name"]}</h3>
							<h4><span class="price">{$totalprice} ریال</span> 
							<span class="time">{$val["time"]}  ماهه </span></h4>
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
if (($j % 4 == 0)and (count($plans)!=$j)) $html.="</div><div class='four-tables'>";
if (($j % 4 == 0)and (count($plans)==$j)) $html.="</div>";
}
if ($j % 2 != 0) $html.="</div>";
$html.=<<<cd
			</div>
			</div>
			<div class="container">
			<div class="sixteen columns">
				<div class="four-tables">
cd;
$i = 0;
$j = 0;
foreach($trafic as $key => $val)
{
   ++$i;
   ++$j; 
$html.=<<<cd
					<div class='pricing-table'>
						<div class="color-3">
							<h3>بسته ترافیک اضافه</h3>
								<h4>
									<span class="price">{$val["price"]} ریال </span> 
									<span class="time">{$val["subject"]}</span> 
								</h4>
								<ul>
									<li>{$val["cnt"]} گیگابایت</li>		
								</ul>
								<a href="#" class="sign-up"><span>پرداخت هزینه</span></a>
						</div>
					</div>
cd;
if (($j % 4 == 0)and (count($plans)!=$j)) $html.="</div><div class='four-tables'>";
if (($j % 4 == 0)and (count($plans)==$j)) $html.="</div>";
}
//if ($j % 2 != 0) $html.="</div>";
$html.=<<<cd
           </div>
			</div>
			</div>
		</div>		
cd;
	echo $html;

?>