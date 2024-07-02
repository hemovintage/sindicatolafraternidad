<?php

session_start();

if(empty($_REQUEST['id']))
{
	die();
}
else
{
	$id = $_REQUEST['id'];
	$visible = $_REQUEST['visible'];
}

require_once('../include/Video.php');
require_once('../include/constants.php');

$video = new Video();
$hide = $video->changeEstadoVideoById($id,$visible);

$redirect = FULL_PATH . "video-listar.php"; 
header("Location: $redirect");

?>