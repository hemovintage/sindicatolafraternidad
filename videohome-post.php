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
	$id = 1;
	$titulo = mysql_escape_mimic($_POST['video_titulo']);
	$videoId = mysql_escape_mimic(trim($_POST['video_id']));
	$source = mysql_escape_mimic($_POST['video_source']);
	
	////PEGO EN BASE DE DATOS LA NOTICIA...////
	
	require_once('include/Video.php');
	//instancio
	$video = new Video();
	
	//setea noticia 
	$update = $video->updateVideoHome($id,$titulo,$videoId,$source);

	

	if(empty($update))
	{
		echo '0';
		
	}
	else
	{
		header('Location: noticia-listar.php');
	}
	
	
	
}
else
{
	header('Location: noticia-listar.php');
}


?>