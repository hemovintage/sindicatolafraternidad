<?php
/*
error_reporting(-1);
ini_set('display_errors',1); 
error_reporting(E_ALL);
*/
@session_start();

function mysql_escape_mimic($inp) {
    if(is_array($inp))
        return array_map(__METHOD__, $inp);

    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
    }

    return $inp;
} 


if(!empty($_POST))
{

	//agarro de post
	$id = mysql_escape_mimic($_POST['id']);
	$titulo = mysql_escape_mimic($_POST['video_titulo']);
	$videoId = mysql_escape_mimic(trim($_POST['video_id']));
	$source = mysql_escape_mimic($_POST['video_source']);
	$categoria = mysql_escape_mimic($_POST['video_categoria']);
	
	////PEGO EN BASE DE DATOS LA NOTICIA...////
	
	require_once('include/Video.php');
	//instancio
	$video = new Video();
	
	//setea noticia /// description,$videoId,$source,$categoriaId)
	$update = $video->updateVideo($id,$titulo,$videoId,$source,$categoria);
	
	
	header('Location: video-listar.php');//tiene que direccionar a video-listar.php

	
	
	
}
else
{
	header('Location: video-listar.php'); // video-listar.php
}


?>