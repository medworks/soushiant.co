-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2013 at 04:28 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `soushiant`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `ndate` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `resource` varchar(50) NOT NULL,
  `catid` int(11) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pos` tinyint(4) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `acclevel` tinyint(4) NOT NULL,
  `plugin` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `contenttype` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`id`, `name`, `pos`, `order`, `acclevel`, `plugin`, `content`, `contenttype`) VALUES
(1, 'اخبار', 1, 1, 1, '', 'jsj sj hc uigjhbhghgh', 2),
(2, 'سعید', 2, 1, 2, '', 'm kjnhubuyggnomnjo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secid` int(11) NOT NULL,
  `catname` varchar(25) CHARACTER SET utf8 NOT NULL,
  `latinname` varchar(25) CHARACTER SET utf8 NOT NULL,
  `describe` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `secid`, `catname`, `latinname`, `describe`) VALUES
(5, 2, 'روانشناسی کودک', 'sycologists', 'اطلاعات روانشناسی'),
(6, 1, 'برنامه نویسی', 'programming', 'انواع زبان های برنامه نویسی');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `body`) VALUES
(1, 'شاتل', 'در طول تاریخ، تبدیل شدن به یک ابر انسان با توان فیزیکی بسیار بالا، همواره از یکی آرزوهای بشری بوده . این حقیقت را می توان به آسانی در افسانه ها، کمیک استریپ ها و فیلم ها مشاهده کرد. گویا دانشجویان دانشگاه پنسیلوانیا قدمی هر چند کوچک ولی مهم در این رابطه برداشته اند. آن ها بازویی رباتیک خلق کرده اند که توان بازوی انسان را به میزان زیادی افزایش می دهد.'),
(2, 'مخابرات', 'این بازوی رباتیک موسوم به تایتان آرم (Titan Arm)، تا ۲۰ کیلوگرم بر توان بلند کردن اشیا توسط افراد می افزاید. به طور مثال اگر شما به آسانی جسمی با وزن 10 کیلوگرم را بلند می کنید، توسط این بازو به آسانی از عهده اجسامی با وزن ۳۰ کیلوگرم برخواهید آمد. مخترعین این وسیله موفق به کسب جایزه ۴۵ هزار دلاری جیمز دایسون اَوارد (James Dyson Award) شده اند.آن چه بازوی تایتان را از محصولات مشابه متمایز می کند، تکنیک های مدرن و ارزان تر به کار رفته در ساخت آن است. در این اسکلت خارجی رباتیک، از موتورهای کوچک و فشرده پَنکِیکی بهره گرفته شده. '),
(3, 'صبانت', 'همچنین استفاده از آلمینیوم، تا حدی هزینه های مربوط به ساخت را کاهش داده.مخترعین جوان تایتان آرم در گام بعدی قصد دارند جنبه تجاری اختراع شان را تقویت کنند. آنها اعتقاد دارند به زودی این محصول بازار خود را برای بیماران جسمی حرکتی و کارگران یدی، پیدا خواهد کرد. لازم به ذکر است که تایتان آرم، انرژی خود را از طریق باتری تامین می کند.'),
(4, 'مبین نت', 'گرچه این اختراع نسبت به محصولات مشابه، قیمت تمام شده کمتری خواهد داشت، با این حال، با هزینه تولید ۱۹۰۰ دلاری، شاید تایتان آرم هنوز آمادگی تجاری شدن را نداشته باشد. مخترعین تایتان آرم قصد دارند، جایزه ۴۵ هزار دلاری شان را صرف توسعه این محصول و حفظ پتنت های مربوط به طراحی آن کنند.'),
(5, 'ایرانسل', 'گرچه این اختراع نسبت به محصولات مشابه، قیمت تمام شده کمتری خواهد داشت، با این حال، با هزینه تولید ۱۹۰۰ دلاری، شاید تایتان آرم هنوز آمادگی تجاری شدن را نداشته باشد. مخترعین تایتان آرم قصد دارند، جایزه ۴۵ هزار دلاری شان را صرف توسعه این محصول و حفظ پتنت های مربوط به طراحی آن کنند.');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(60) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `body` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `subject`, `body`) VALUES
(2, './gallerypics/respic.png', 'نمایش رسپانسیو', ''),
(3, './gallerypics/Responsive2.png', 'نمایش رسپانسیو 2', ''),
(4, './gallerypics/web-design-belfast.jpg', 'طراحی زیبا', '');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `image` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `ndate` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `resource` varchar(50) NOT NULL,
  `catid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=125 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `subject`, `image`, `body`, `ndate`, `userid`, `resource`, `catid`) VALUES
(47, 'کامل شدن امکان ویرایش اخبار', './newspics/logo.png', '<p>بدینوسیه اعلام می دارم که امکان ویرایش اخبار به اتمام رسید</p>', '2013-06-11 21:10:25', 1, 'حاتمی', 5),
(48, 'تست هدر', '', '<p>در این تست مشکل ارسال هدر بررسی می شود</p>', '2013-06-10 06:08:05', 1, 'حاتمی', 5),
(93, 'کامل شدن امکان ویرایش اخبار', '', '<p>بدینوسیه اعلام می دارم که امکان ویرایش اخبار به اتمام رسید</p>', '2013-06-11 02:33:06', 1, 'حاتمی', 5),
(115, 'کامل شدن امکان ویرایش اخبار', '', '<p>بدینوسیه اعلام می دارم که امکان ویرایش اخبار به اتمام رسید</p>', '2013-06-10 02:25:08', 1, 'حاتمی', 6),
(117, 'کامل شدن امکان ویرایش اخبار', '', '<p>بدینوسیه اعلام می دارم که امکان ویرایش اخبار به اتمام رسید</p>', '2013-06-11 05:11:04', 1, 'حاتمی', 6),
(118, 'کامل شدن امکان ویرایش اخبار', '', '<p>بدینوسیه اعلام می دارم که امکان ویرایش اخبار به اتمام رسید</p>', '2013-06-11 15:08:42', 1, 'حاتمی', 6),
(119, 'کامل شدن امکان ویرایش اخبار', '', '<p>بدینوسیه اعلام می دارم که امکان ویرایش اخبار به اتمام رسید</p>', '2013-06-10 10:09:25', 1, 'حاتمی', 6),
(120, 'کامل شدن امکان ویرایش اخبار', '', '<p>بدینوسیه اعلام می دارم که امکان ویرایش اخبار به اتمام رسید</p>', '2013-06-11 05:28:09', 1, 'حاتمی', 5),
(121, 'تست دوم', './newspics/logo.png', 'در طول تاریخ، تبدیل شدن به یک ابر انسان با توان فیزیکی بسیار بالا، همواره از یکی آرزوهای بشری بوده . این حقیقت را می توان به آسانی در افسانه ها، کمیک استریپ ها و فیلم ها مشاهده کرد. گویا دانشجویان دانشگاه پنسیلوانیا قدمی هر چند کوچک ولی مهم در این رابطه برداشته اند. آن ها بازویی رباتیک خلق کرده اند که توان بازوی انسان را به میزان زیادی افزایش می دهد.\nاین بازوی رباتیک موسوم به تایتان آرم (Titan Arm)، تا ۲۰ کیلوگرم بر توان بلند کردن اشیا توسط افراد می افزاید. به طور مثال اگر شما به آسانی جسمی با وزن 10 کیلوگرم را بلند می کنید، توسط این بازو به آسانی از عهده اجسامی با وزن ۳۰ کیلوگرم برخواهید آمد. مخترعین این وسیله موفق به کسب جایزه ۴۵ هزار دلاری جیمز دایسون اَوارد (James Dyson Award) شده اند.آن چه بازوی تایتان را از محصولات مشابه متمایز می کند، تکنیک های مدرن و ارزان تر به کار رفته در ساخت آن است. در این اسکلت خارجی رباتیک، از موتورهای کوچک و فشرده پَنکِیکی بهره گرفته شده. همچنین استفاده از آلمینیوم، تا حدی هزینه های مربوط به ساخت را کاهش داده.مخترعین جوان تایتان آرم در گام بعدی قصد دارند جنبه تجاری اختراع شان را تقویت کنند. آنها اعتقاد دارند به زودی این محصول بازار خود را برای بیماران جسمی حرکتی و کارگران یدی، پیدا خواهد کرد. لازم به ذکر است که تایتان آرم، انرژی خود را از طریق باتری تامین می کند.', '2013-08-26 11:20:31', 1, 'حاتمی', 5),
(123, 'تست اول', './newspics/logo.png', 'سامسونگ در نظر دارد توسط این پلتفرم داده های مربوط به محصولات مختلف را نرمال سازی کرده و در قالب یک اپلیکیشن مدیریت کند. اما از آن جایی که تمرکز اصلی سامسونگ بر روی سخت افزار است، شاید در توسعه نرم افزار سامی با دشواری هایی روبرو شود. لوک جولیا در این مورد گفته که شاید سامسونگ فعلا در زمینه نرم افزار و سرویس ها دانش کافی نداشته باشد ولی دنبال ورود به این عرصه و ربودن گوی سبقت از رقبا است.', '2013-08-26 11:39:54', 1, 'حاتمی', 6),
(124, 'تست اول', './newspics/logo.png', 'پیش از این نوشتیم که سامسونگ از مسیر تلویزیون های هوشمند  قدم هایی جدی برای ورود به عرصه اینترنت اشیا برداشته . حال خبر رسیده که لوک جولیا، مهندس نرم افزار، و مدیر سابق تیم Siri در شرکت اپل، هم اکنون در سامسونگ بر روی پلتفرمی مرتبط با اینترنت اشیا کار می کند.\nلوک جولیا در سال 2012 اپل را به مقصد سامسونگ ترک کرد و در حال حاضر نفر دوم مرکز نوآوری های باز سامسونگ است. او در این شرکت بر روی پروژه "معماری سامسونگ برای تعاملات چند حالته" موسوم به سامی (SAMI) کار می کند. این پلتفرم، داده های دستگاه ها و اشیای متصل به شبکه را جمع آوری، پردازش و توزیع می نماید. پلتفرم سامی، قادر خواهد بود تمام داده های مربوط به گجت های پوشیدنی، خانه های هوشمند و حتی خودروها را در یک اپلیکیشن تجمیع کند.\nنکته جالب در مورد این سیستم، داشتن یک دستیار شخصی مجازی است که مانند Siri به نظر می رسد. البته تفاوت هایی نیز وجود دارد. Siri داده ها را در اکوسیستم اختصاصی اپل جمع آوری و تجمیع می کند، در حالی که سامی پلتفرمی باز محسوب می شود. در حال حاضر، سامسونگ با حدود 50 شرکت مختلف از جمله Fitbit و Pebble در زمینه تست و توسعه فناوری های مرتبط با این پلتفرم همکاری می کند.', '2013-08-26 11:55:23', 1, 'حاتمی', 6);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `pos` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `speeddl` int(11) NOT NULL,
  `speedup` int(11) NOT NULL,
  `time` varchar(10) NOT NULL,
  `trafic` int(11) NOT NULL,
  `price` float NOT NULL,
  `avarage` float NOT NULL,
  `detail` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `sid`, `pos`, `name`, `speeddl`, `speedup`, `time`, `trafic`, `price`, `avarage`, `detail`) VALUES
(1, 1, 1, 'ECO 128/128 kbps', 128, 128, '1', 3, 14700, 0, '<p>ندارد</p>'),
(2, 2, 1, 'سعید', 128, 128, '3', 3, 14700, 0, ''),
(3, 1, 0, 'ECO 256/256kbps', 256, 256, '1', 3, 14700, 0, '<p>ندارد</p>'),
(4, 1, 0, 'ECO 512/512 kbps', 512, 512, '1', 3, 14700, 0, '<p>ندارد</p>'),
(5, 1, 0, 'ECO 1024/1024 kbps', 1024, 1024, '1', 3, 14700, 0, '<p>ندارد</p>'),
(6, 1, 2, 'ECO 2048/2048 kbps', 2048, 2048, '1', 3, 14700, 0, '<p>ندارد</p>');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secname` varchar(50) NOT NULL,
  `latinname` varchar(50) NOT NULL,
  `describe` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `secname`, `latinname`, `describe`) VALUES
(1, 'کامپیوتر', 'camputer', ''),
(2, 'روانشناسی', 'sycologist', 'اطلاعات روانشناسی'),
(3, 'الکترونیک', 'electronic', 'نرم افزار های الکترونیک'),
(4, 'معماری', 'artituvjh', 'گروه معماری'),
(5, 'روانشناسی2', 'sycologist', 'نرم افزار های الکترونیک'),
(6, 'روانشناسی2', 'sycologist', 'نرم افزار های الکترونیک'),
(7, 'معماری2', 'artituvjh', 'این سایت بر پایه phpطراحی شده است که باعث سهولت در');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `image` varchar(60) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `subject`, `image`, `body`) VALUES
(1, 'خدمت اینترنت', '', 'همانطور که تا کنون متوجه شده اید، اپلیکیشن تلفن مربوط به اندرويد 4.4، ظاهری جدید پیدا کرده و مشخصه های مختلفی به آن اضافه شده. خبرها حاکی از این است که بخش تماس های اندروید هم تا اوایل سال 2014 به دیتابیس عظیمی از تصاویر مخاطبین مجهز می گردد. این دیتابیس چیزی نیست جز همان تصاویر پروفایل اشخاص در گوگل پلاس. به طوری که شماره تلفن تائید شده افراد در حساب های گوگل، با تصویر پروفایل گوگل پلاس آن ها جفت می شود.'),
(2, 'خدمت سخت افزار', '', 'در این صورت هر وقت شما با فردی که تلفن اندرویدی دارد تماس بگیرید، تصویر پروفایل گوگل پلاس شما بر روی صفحه تماس های دریافتی او نقش می بندد، و صد البته این که هر گاه آن شخص با شما تماس بگیرد، شما هم تصویر پروفایل گوگل پلاس او را خواهید دید. این قابلیت، به ویژه، زمانی سودمند خواهد بود که شما شماره آن شخص را به لیست مخاطبین خود اضافه نکرده باشید، ولی چهره آن شخص را از روی تصویرش تشخیص دهید.'),
(3, 'خدمت بارکد', '', 'این مشخصه جدید در اندروید به شما این امکان را می دهد که به جای این که دیگران برای شماره شما یک تصویر انتخاب کنند، خودتان تصویر مرتبط با شماره تان را در دستگاه های آن ها تعیین کنید. البته هنوز مشخص نیست که دقیقاً کدام یک از نسخه های اندروید از این ویژگی بهره خواهند برد. با این حال گوگل باز هم نشان داد که قصد دارد از حجم بسیار گسترده داده های کاربرانش بهترین استفاده را کرده، و با عرضه قابلیت هایی متکی به این داده های منحصر به فرد، و یکپارچه کردن خدمات متنوعش، سایر رقبا به چالش بکشاند'),
(4, 'خدمت برنامه نویسی', '', 'بلومبرگ گزارش می کند که «منابعی آشنا به برنامه های اپل» می گویند این شرکت قصد دارد سال آینده دو آیفون جدید با نمایشگر خمیده را راهی بازار کند. این دو اسمارت فون از نمایشگرهای ۴.۷ اینچی و ۵.۵ اینچی بهره مند خواهند بود، که هر دو به شکل قابل توجهی از نمایشگر رتینا ۴ اینچی مورد استفاده در آیفون 5S بزرگتر هستند. و البته می توان آنها را رقبایی برای گلکسی اس ۴ یا نوت ۳ سامسونگ محسوب کرد.'),
(5, 'خدمت طراحی سایت', '', '<div>این گزارش همچنین شامل جزئیاتی درباره تلاش های اپل در زمینه سنسورهای حسگر فشار روی صفحه نمایشگر است. اگرچه حدس زده می شود چنین کارایی (تشخیص اینکه نمایشگر با چه میزان فشاری لمس شده) در مدل های ۲۰۱۴ آیفون گنجانده نشود و برنامه ای برای مدلهای بعدی باشد.</div>\r\n<div>مدتی است که شایعه آیفون هایی با نمایشگر بزرگتر بر سر زبانها است و پیش از این هم وال استریت ژورنال به نقل از DisplaySearch اندازه نمایشگرهایی منطبق بر خبر بلومبرگ را تایید کرده بود. البته بلومبرگ اولین منبع معتبری است که به احتمال خمیده بودن نمایشگر اشاره کرده است.</div>');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Theme_Name', 'default'),
(2, 'About_System', '<p>گروه مدیا تک بر در سال 1392 تشکیل و به جهت رفاه حال مشتریان عزیز</p>'),
(3, 'Site_Title', 'سیستم مدیریت محتوای مدیا تکنیک'),
(4, 'Site_KeyWords', 'مدیا تک - سی ام اس - مدیریت محتوا'),
(5, 'Site_Describtion', 'این سایت بر پایه phpطراحی شده است که باعث سهولت در'),
(6, 'Admin_Email', 'admin@mediateq.ir'),
(7, 'News_Email', 'news@mediateq.ir'),
(8, 'Contact_Email', 'info@mediateq.ir'),
(9, 'Max_Page_Number', '5'),
(10, 'Max_Post_Number', '3'),
(11, 'FaceBook_Add', 'facebook.com'),
(12, 'Twitter_Add', 'twitter.com'),
(13, 'Rss_Add', '127.0.01/media/rssfeed.php'),
(14, 'YouTube_Add', 'youtube.com'),
(15, 'Tell_Number', '7623666'),
(16, 'Fax_Number', '7634562'),
(17, 'Address', 'مشهد - سه راه فلسطین - ساختمان 202 - طبقه اول - واحد 3'),
(18, 'Is_Smtp_Active', 'yes'),
(19, 'Smtp_Host', 'smtp.gmail.com'),
(20, 'Smtp_User_Name', 'hatami4510@gmail.com'),
(21, 'Smtp_Pass_Word', '12345'),
(22, 'Smtp_Port', '465'),
(23, 'Email_Sender_Name', 'گروه مدیاتک');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(60) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `body` varchar(250) NOT NULL,
  `pos` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `image`, `subject`, `body`, `pos`) VALUES
(2, './slidespics/seo.jpg', 'تست سعید حاتمی', 'این تست جهت حل مشکلات ویرایش می باشد', 3),
(3, './slidespics/slide1.jpg', 'تست اسم عکس', 'تست توضیحات عکس سعید حاتمی', 1),
(4, './slidespics/slide2.png', 'تست سابمیت', 'تست دوم', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trafic`
--

CREATE TABLE IF NOT EXISTS `trafic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `cnt` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `trafic`
--

INSERT INTO `trafic` (`id`, `pid`, `subject`, `cnt`, `price`) VALUES
(1, 1, 'یک گیگا بایت', 1, 50000),
(2, 1, 'سه گیگا بایت', 3, 145000),
(3, 2, 'یک گیگا بایت2', 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `family` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `image`, `email`, `username`, `password`, `type`) VALUES
(1, 'سعید', 'حاتمی', '../userspics/logo.png', 'hatami4560@yahoo.com', 'php', '5f93f983524def3dca464469d2cf9f3e', 0),
(2, 'علی رضا', 'صادقی نژاد', './newspics/editnews.png', 'r.sadeghi@yahoo.com', 'reza', '4510', 1),
(3, 'علی', 'قائمی', './newspics/works.png', 'ali.ghaemi@gmail.com', 'ghaemi', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(4, 'آرش', 'خویتندار', './newspics/addworks.png', 'arash.kh@gmail.com', 'arash', '827ccb0eea8a706c4c34a16891f84e7b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `link` varchar(20) NOT NULL,
  `sdate` datetime NOT NULL,
  `fdate` datetime NOT NULL,
  `catid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=154 ;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `subject`, `image`, `body`, `link`, `sdate`, `fdate`, `catid`) VALUES
(100, 'تست اول', './workspics/logo.png', 'در طول تاریخ، تبدیل شدن به یک ابر انسان با توان فیزیکی بسیار بالا، همواره از یکی آرزوهای بشری بوده . این حقیقت را می توان به آسانی در افسانه ها، کمیک استریپ ها و فیلم ها مشاهده کرد. گویا دانشجویان دانشگاه پنسیلوانیا قدمی هر چند کوچک ولی مهم در این رابطه برداشته اند. آن ها بازویی رباتیک خلق کرده اند که توان بازوی انسان را به میزان زیادی افزایش می دهد.', '', '2013-06-01 00:00:00', '2013-08-17 00:00:00', 5),
(151, 'تست سابمیت', './workspics/logo.png', 'این بازوی رباتیک موسوم به تایتان آرم (Titan Arm)، تا ۲۰ کیلوگرم بر توان بلند کردن اشیا توسط افراد می افزاید. به طور مثال اگر شما به آسانی جسمی با وزن 10 کیلوگرم را بلند می کنید، توسط این بازو به آسانی از عهده اجسامی با وزن ۳۰ کیلوگرم برخواهید آمد. مخترعین این وسیله موفق به کسب جایزه ۴۵ هزار دلاری جیمز دایسون اَوارد (James Dyson Award) شده اند.آن چه بازوی تایتان را از محصولات مشابه متمایز می کند، تکنیک های مدرن و ارزان تر به کار رفته در ساخت آن است. در این اسکلت خارجی رباتیک، از موتورهای کوچک و فشرده پَنکِیکی بهره گرفته شده. ', '', '2013-06-26 19:07:42', '2013-07-03 19:07:42', 6),
(152, 'تست سابمیت12', './workspics/logo.png', 'همچنین استفاده از آلمینیوم، تا حدی هزینه های مربوط به ساخت را کاهش داده.مخترعین جوان تایتان آرم در گام بعدی قصد دارند جنبه تجاری اختراع شان را تقویت کنند. آنها اعتقاد دارند به زودی این محصول بازار خود را برای بیماران جسمی حرکتی و کارگران یدی، پیدا خواهد کرد. لازم به ذکر است که تایتان آرم، انرژی خود را از طریق باتری تامین می کند.', '', '2013-08-16 11:21:35', '2013-07-16 11:21:35', 5),
(153, 'تست ورک', './workspics/logo.png', 'گرچه این اختراع نسبت به محصولات مشابه، قیمت تمام شده کمتری خواهد داشت، با این حال، با هزینه تولید ۱۹۰۰ دلاری، شاید تایتان آرم هنوز آمادگی تجاری شدن را نداشته باشد. مخترعین تایتان آرم قصد دارند، جایزه ۴۵ هزار دلاری شان را صرف توسعه این محصول و حفظ پتنت های مربوط به طراحی آن کنند.', 'www.mediateq.ir', '2013-07-23 11:13:56', '2013-08-22 11:13:56', 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
