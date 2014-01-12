<?php
	header('Content-Type: text/html; charset=UTF-8');
	include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();	
	$seo = Seo::GetSeo(); 	
	$company = $db->Select('company',NULL,"id={$_GET[cid]}");
	$plans = $db->SelectAll('plans',"*","sid={$_GET[cid]}","speeddl ASC");
	
	//echo $db->cmd;
	//$db->cmd = "SELECT * FROM plans GROUP By name HAVING sid={$_GET[cid]}";
	//echo $db->cmd;
	//$res = $db->RunSQL();
	//$plans = array();
    //if ($res)
   // {
    //    while($row = mysqli_fetch_array($res)) $plans[] = $row;
   // }
	
	$seo->Site_Title ="چاپ قیمت سرویس های شرکت "." ". $company["name"] ;	
	
    $uniq = array();
    $speeddl = array();
    foreach ($plans as $key=>$val) $speeddl[] =$val["speeddl"];
    $uniq = array_unique($speeddl);
    //var_dump($uniq);  
	
	
	

$html=<<<cd

<div class="table-standard">
cd;
foreach ($uniq as $key=>$val)
{
	$plan = $db->SelectAll('plans',"*","sid={$_GET[cid]} AND speeddl={$val}","pid ASC,".'"time"'." ASC");
	//echo $db->cmd;
	//foreach ($plan as $pkey=>$pval)
	//{
$html.=<<<cd
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td class="tdtitle" style="border-left:0 none;" valign="baseline">نام سرویس: {$plan[0]["name"]}</td>
				<td colspan="4" class="tdtitle" valign="baseline">سرعت: {$plan[0]["speeddl"]}/{$plan[0]["speedup"]} کیلو بیت بر ثانیه</td>
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
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$plan[0]["trafic"]}</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$plan[1]["trafic"]}</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$plan[2]["trafic"]}</td>
				<td class="tdbox lcol align-c" style="border-bottom:0 none;" valign="baseline">{$plan[3]["trafic"]}</td>
			</tr>
			<tr>
				<td class="tdbox" style="border-bottom:0 none;" valign="baseline">هزینه اشتراک / تومان</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$plan[0]["price"]}</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$plan[1]["price"]}</td>
				<td class="tdbox align-c" style="border-bottom:0 none;" valign="baseline">{$plan[2]["price"]}</td>
				<td class="tdbox lcol align-c" style="border-bottom:0 none;" valign="baseline">{$plan[3]["price"]}</td>
			</tr>
			<tr>
				<td class="tdbox even" valign="baseline">متوسط هزینه برای هر ماه / تومان</td>
				<td class="tdbox even align-c" valign="baseline">{$plan[0]["average"]}</td>
				<td class="tdbox even align-c" valign="baseline">{$plan[1]["average"]}</td>
				<td class="tdbox even align-c" valign="baseline">{$plan[2]["average"]}</td>
				<td class="tdbox lcol even align-c" valign="baseline">{$plan[3]["average"]}</td>
			</tr>
		</tbody>
	</table>
cd;
//}
}
$html.=<<<cd
<center class="cyan">
   <a href="javascript:window.print()" class="button color" style="color:#fff !important">چاپ این صفحه</a>
 </center>   
</div>

cd;
return  $html;
?>