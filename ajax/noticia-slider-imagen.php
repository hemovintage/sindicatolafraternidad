<?php

session_start();

if(empty($_REQUEST['idNoticiaImagen']))
{
	die();
}
else
{
	$idImagen = $_REQUEST['idNoticiaImagen'];
}

require_once('../include/constants.php');
require_once('../include/NoticiaSlider.php');


$noticia = new NoticiaSlider();
$erase = $noticia->unsetImageForNoticia($idImagen);

$data = array( 'result' => 1 );

header('Content-type: application/json');

echo json_encode( $data );
?>