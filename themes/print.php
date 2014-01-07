<?php
	header('Content-Type: text/html; charset=UTF-8');
	include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();	
	$seo = Seo::GetSeo(); 	
	$company = $db->Select('company',NULL,"id={$_GET[cid]}");
	$plans = $db->SelectAll('plans',"*","sid={$_GET[cid]}","name ASC");
	//echo $db->cmd;
	$seo->Site_Title ="چاپ قیمت سرویس های شرکت "." ". $company["name"] ;	
	
	

$html=<<<cd
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/print.css">
</head>
<body>
<div class="table-standard">
cd;
foreach ($plans as $key=>$val)
{
$html.=<<<cd
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td class="tdtitle" style="border-left:0 none;" valign="baseline">نام سرویس: {$val["name"]}</td>
				<td colspan="4" class="tdtitle" valign="baseline">سرعت تا:&nbsp; {$val["speeddl"]}/<strong>{$val["speedup"]}</strong>کیلو بیت بر ثانیه</td>
			</tr>
			<tr>
				<td class="tdbox" style="border-bottom:0 none;" valign="baseline" width="*">مدت سرویس</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline" width="100">یک ماهه</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline" width="100">سه ماهه</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline" width="100">شش ماهه</td>
				<td class="tdbox lcol align-c" style="border-bottom:0 none;" valign="baseline" width="100">یک ساله</td>
			</tr>
			<tr>
				<td class="tdbox" style="border-bottom:0 none;" valign="baseline">میزان ترافیک/ گیگا بایت</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$val["trafic"]}</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$val["trafic"]}</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$val["trafic"]}</td>
				<td class="tdbox lcol align-c" style="border-bottom:0 none;" valign="baseline">{$val["trafic"]}</td>
			</tr>
			<tr>
				<td class="tdbox" style="border-bottom:0 none;" valign="baseline">هزینه اشتراک / تومان</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$val["price"]}</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$val["price"]}</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$val["price"]}</td>
				<td class="tdbox lcol align-c" style="border-bottom:0 none;" valign="baseline">{$val["price"]}</td>
			</tr>
			<tr>
				<td class="tdbox even" valign="baseline">متوسط هزینه برای هر ماه / تومان</td>
				<td class="tdbox even align-c" valign="baseline">{$val["average"]}</td>
				<td class="tdbox even align-c" valign="baseline">{$val["average"]}</td>
				<td class="tdbox even align-c" valign="baseline">{$val["average"]}</td>
				<td class="tdbox lcol even align-c" valign="baseline">{$val["average"]}</td>
			</tr>
		</tbody>
	</table>
cd;
}
$html.=<<<cd
</div>
</body>
</html>
cd;
return  $html;
?>