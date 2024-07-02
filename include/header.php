<?php 
//instancio el archivo que evalua variables pasadas por get 
require_once('include/contents.php');
require_once('include/constants.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="author" content="Sindicato la Fraternidad" />
	<title>Sindicato la Fraternidad - <?php echo $content_fullname; ?> </title>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/thickboxC.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/menu.js" type="text/javascript"></script>
    <script src="js/general.js" type="text/javascript"></script>
    <script src="js/thickboxC.js" type="text/javascript"></script>
    <script src="js/jquery.flash.js" type="text/javascript" ></script>
    <script src="js/jquery.lightbox-0.5.js" type="text/javascript" ></script>
</head>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23182316-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<body>
	<div class="wrapper">
	<!-- HEADER -->
        <div class="header">
            <!-- MENU -->
            <?php
            require_once('menu.php');
            ?>
        </div>

<?php 

/* INCLUYO EL CONTENIDO DEL OBJETO CORRESPONDIENTE */
require_once('objetos/'.$content_file);


?>