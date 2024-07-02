<?php
session_start();

require_once('../include/Noticia.php');

$titulo = $_POST['noticia_titulo'];
$resumen = $_POST['noticia_resumen'];
$texto = $_POST['noticia_cuerpo'];
$linkExterno = $_POST['noticia_resumen'];
$fuente = $_POST['noticia_fuente'];
$categoria = $_POST['noticia_categoria'];
$visible = 0;

$noticia = new Noticia();

$add = $noticia->setNoticia($titulo,$resumen,$texto,$linkExterno,$fuente,$categoria,$visible);

if(empty($add))
{
	echo '0';
}
else
{
	echo '1';
}
?>