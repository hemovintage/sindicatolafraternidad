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
$erase = $video->eraseVideoById($id);


$redirect = FULL_PATH . "video-listar.php";
header("Location: $redirect");
?>