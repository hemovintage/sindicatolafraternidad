<?php require_once('include/constants.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sindicato La Fraternidad </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
 	<div style="height:80px; background-color:#ccc;text-align:center; border-bottom:3px solid #000;  ">
  		<img src="http://www.sindicatolafraternidad.org/images/logo.png" height="75" align="middle" style="padding-bottom:5px;" />
  	</div>

    <nav class="navbar navbar-default" role="navigation">
   <div class="navbar-header">
      <a class="navbar-brand" href="/">Sindicato La Fraternidad</a>
   </div>
   <div>
      <ul class="nav navbar-nav">
        <!--
          <li class="active">
              <a href="#">iOS</a>
          </li>
        -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               Noticias 
               <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
               <li><a href="noticia-listar.php">Listar</a></li>
               <li class="divider"></li>
               <li><a href="noticia-add.php">Agregar</a></li>
            </ul>
        </li>
        <?php 
        if($_SESSION['nivel'] == 2){
        ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               Noticias Slider
               <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
               <li><a href="noticia-slider-listar.php">Listar</a></li>
               <li class="divider"></li>
               <li><a href="noticia-slider-add.php">Agregar</a></li>
            </ul>
        </li>
        <?php
        }//if nivel
        ?>
		 <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               Videos 
               <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
			   <li><a href="video-add.php">Agregar Video</a></li>
			   <li class="divider"></li>
			   <li><a href="video-listar.php">Listar Videos</a></li>
			   <li class="divider"></li>
               <li><a href="videohome-add.php">Video de Home</a></li>
			   <!--
               <li class="divider"></li>
               <li><a href="noticia-add.php">Agregar</a></li>
			   -->
            </ul>
         </li>
		 <li>
              <a href="http://www.sindicatolafraternidad.org/">Ir al Sitio</a>
        </li>
		<li class="active">
            <a href="logout.php">Cerrar Sesión</a>
		</li>
      </ul>
   </div>
</nav>
