<?php
  error_reporting (E_ALL ^ E_NOTICE);
  
  define("_DB_NAME","soushiant");
  define("_DB_USER", "root");
  define("_DB_PASS", "");
  define("_DB_SERVER", "localhost");
  define("_DOMAIN", "http://localhost/soushiant.co");
  

  /*
  define("_DB_NAME","amjadi_mediatec");
  define("_DB_USER", "amjadi_mediatec");
  define("_DB_PASS", "mojisaeid&*&");
  define("_DB_SERVER", "localhost");
  define("_DOMAIN", "media.mediateq.ir");
  */
  
  define("_USER_IP",$_SERVER['REMOTE_ADDR']);  
  define("_ADMIN", 1);
  define("_USER", 2);
  define("_ANONYMOUS", 3); 
/*
  define ('SITE_ROOT', '');
  define ('OS_ROOT', $_SERVER['DOCUMENT_ROOT']);
*/
  
  define ('SITE_ROOT', '/soushiant');
  define ('OS_ROOT', $_SERVER['DOCUMENT_ROOT']."/soushiant.co");
  
  
?>