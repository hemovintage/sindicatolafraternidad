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
require_once('../include/Noticia.php');


$noticia = new Noticia();
$erase = $noticia->unsetImageForNoticia($idImagen);

$data = array( 'result' => 1 );

header('Content-type: application/json');

echo json_encode( $data );
?>