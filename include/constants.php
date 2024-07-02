<?php
/* ADMIN CONSTANTS */
error_reporting(E_ALL);
ini_set('display_errors', 1);

define("TIME_LIMIT", 0);

//PATHS
define('BASE_DOMAIN','http://sindicatolafraternidad.org/');
define('FULL_PATH_SITE',BASE_DOMAIN.''); 
define('FULL_PATH_SITE_IMAGES',BASE_DOMAIN.'images/'); 
define('FULL_PATH_SITE_IMAGES_UPLOAD',BASE_DOMAIN.'images/upload/'); 
define('FULL_PATH_SITE_IMAGES_UPLOAD_OLD','http://www.sindicatolafraternidad.org/images/upload/'); 

define('FULL_PATH','http://sindicatolafraternidad.org/admin/'); 
define('PREVIEW_PATH', BASE_DOMAIN.'Noticias/preview.php');

//define('PATH_IMAGE_UPLOAD','/www/docs/sindicatolafraternidad.org/public_html/images/upload/');
//define('PATH_IMAGE_UPLOAD','/www/docs/sindicatolafraternidad.org/public_html/images/upload/'); 
define('PATH_IMAGE_UPLOAD','/home/uv025222/public_html/images/upload/'); //PRODUCCIONe

//SMTP SERVER
define("MAIL_HOST", "smtp.ladobleayuda.org");
define("MAIL_NAME", "LA DOBLE AYUDA");
//define("MAIL_FROM", "novedades@ladobleayuda.org");
//define("MAIL_USER", "novedades@ladobleayuda.org");
//define("MAIL_PASS", "28154254");
define("MAIL_FROM", "info@ladobleayuda.org");
define("MAIL_USER", "info@ladobleayuda.org");
define("MAIL_PASS", "123456");

define("MAIL_PORT", 2525);

define("MAIL_BODY" , "...");
//define("MAIL_BODY_PATH" , "../newsletter/diciembre-2011/mail.php"); //variable $message
define("MAIL_DESTINATIONS" , "../include/array_mail.php"); //variable $array_mails
define("MAIL_SUBJECT" , "Anuario de actividades 2011");
define("MAIL_MESSAGE" , "...");

//define("MAIL_DESTINY" , "info@ladobleayuda.org");
//define("MAIL_DESTINY" , "hemovintage@gmail.com");


?>
