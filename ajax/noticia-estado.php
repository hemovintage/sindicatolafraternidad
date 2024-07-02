<?php

session_start();

if(empty($_REQUEST['id']))
{
	die();
}
else
{
	$idNoticia = $_REQUEST['id'];
	$visible = $_REQUEST['visible'];
}

require_once('../include/Noticia.php');
require_once('../include/constants.php');

$noticia = new Noticia();
$erase = $noticia->changeEstadoNoticiaById($idNoticia,$visible);


$redirect = FULL_PATH . "noticia-listar.php";
header("Location: $redirect");

?>