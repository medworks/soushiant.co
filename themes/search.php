<?php
   include_once("./config.php");
   include_once("./classes/database.php");
   include_once("./classes/messages.php");
   
   $table = "";
   $field = "";   
   $db = Database::GetDatabase();
   if ($_POST["mark"]=="search")
   {
      $table = "news";
      $field = "subject";
	  $rownum = 0;
	  $rows = $db->SelectAll(
				$table,
				"*",
				"{$field} LIKE '%{$_POST[searchtxt]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			/* if (!$rows) 
			{							
				//header("Location:?item=search&act=do&msg=6");
				header("Location:search.html");
				
			}
			else
			{
			    $cat = "اخبار";
				$success = count($rows);
				foreach($rows as $key=>$val)
				{
				 ++$rownum;
				 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullnews&act=do&wid={$val['id']}' class='srlink'>
					 {$val['subject']}</a></p>";
				}
				$result=<<<rt
			     <p class="sresult"><span>نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span>عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span>تعداد نتایج یافت شده: </span>{$success}</p>
				 {$row}				 
rt;
			} */
				$cat = "اخبار";
				$success = count($rows);
				foreach($rows as $key=>$val)
				{
				 ++$rownum;
				 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='work-fullpage{$val['id']}.html' class='srlink'>
					 {$val['subject']}</a></p>";
				}
				$result=<<<rt
			     <p class="sresult"><span class="font-siz">نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span class="font-siz">عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span class="font-siz">تعداد نتایج یافت شده: </span>{$success}</p>
				 {$row}				 
rt;
   }
   if ($_POST["mark"]=="find")
  {
    $table = $_POST["category"];
    $field = $_POST["subcat"];
	$rows = $db->SelectAll(
				$table,
				"*",
				"{$field} LIKE '%{$_POST[searchtxt]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			/* if (!$rows) 
			{							
				header("Location:?item=search&act=do&msg=6");
			}
			else
			{
               //header("Location:?item=search&act=do");			
			   $success = count($rows);
			   $cat = "";
			   $rownum = 0;
			   switch($_POST["category"])
			   {
					case 'news':
					$cat = "اخبار";
					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullnews&act=do&wid={$val['id']}' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'works':
					$cat = "کارهای ما";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullworks&act=do&wid={$val['id']}' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'articles':
					$cat = "مطالب خواندنی";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullarticles&act=do&wid={$val['id']}' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
			   } */
			   
			   $success = count($rows);
			   $cat = "";
			   $rownum = 0;
			   switch($_POST["category"])
			   {
					case 'news':
					$cat = "اخبار";
					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='news-fullpage{$val['id']}.html' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'works':
					$cat = "پروژه ها";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='work-fullpage{$val['id']}.html' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'articles':
					$cat = "مطالب خواندنی";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='article-fullpage{$val['id']}.html' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
			   } 
			   
			   $result=<<<rt
			     <p class="sresult"><span class="font-siz">نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span class="font-siz">عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span class="font-siz">تعداد نتایج یافت شده: </span>{$success}<p>
				 {$row}				 
rt;
	}
		
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
    	<div class="container">
			<div class="sixteen columns">
				<!-- Page Title -->
				<div id="page-title">
					<h2>جستجو</h2>
					<div id="bolded-line"></div>
				</div>
				<!-- Page Title / End -->
			</div>
		</div>
		<div class="container">
			<form action="" id="searchfrm" method="post">
	                <div class="eight columns">
	                	<div class="headline"><h3>عبارت جستجو</h3></div>
		                <ul id="portfolio-item-meta">
		                	<li>
						        <input type="text" name="searchtxt" class="subject" id="searchtxt" value="{$_POST[searchtxt]}" style="width:320px;font-size:18px;"/>
		                	</li>
		                    <li>
		                    	<p>
						        	<label class="mar-bot" style="margin-top:15px">جستجو در: </label>
						        </p>
						        <p>
							        <input type="radio" name="category" class="subject right mar-lef" id="category" value="news" checked/>
							        <label>اخبار</label>
						        </p>
						        <p>
							        <input type="radio" name="category" class="right subject mar-lef" id="category" value="works" />
							        <label>کارهای ما</label>
						        </p>
						        <p>
							        <input type="radio" name="category" class="subject right mar-lef" id="category" value="articles" />
							        <label>مطالب خواندنی</label>
						        </p>
		                    </li>
		                    <li>
		                    	<p>
						        	<label class="mar-bot">قسمت: </label>
						        </p>
						        <p>  
						        	<input type="radio" name="subcat" class="subject right mar-lef" id="category" value="subject" checked/>
							        <label>عنوان</label>
					        	</p>
						        <p>
							        <input type="radio" name="subcat" class="subject right mar-lef" id="category" value="body" />
							        <label>توضیحات</label>
						        </p>
		                    </li>              
		                </ul>
		            </div>
	                <div class="eight columns">
	                	<div class="headline"><h3>نتایج جستجو</h3></div>
				        {$result}
		            </div>
				<input type="hidden" name="mark" value="find" />
	        </form>
	    </div>
        
cd;
return $html;
?>