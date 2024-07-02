<?php
/*
error_reporting(-1);
ini_set('display_errors',1); 
error_reporting(E_ALL);
*/
@session_start();

require_once('include/constants.php');

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
	$titulo = mysql_escape_mimic($_POST['noticia_titulo']);
	$resumen = mysql_escape_mimic($_POST['noticia_resumen']);
	$texto = mysql_escape_mimic($_POST['noticia_cuerpo']);
	$linkExterno = mysql_escape_mimic($_POST['noticia_linkexterno']);
	$fuente = mysql_escape_mimic($_POST['noticia_fuente']);
	$categoria = $_POST['noticia_categoria'];
    $cita = $_POST['noticia_cita'];
	$tags = $_POST['noticia_tags'];
	
	$preview = $_POST['noticia_preview'];

	if($preview == 0)
	{
		$visible = 0;
	}
	else
	{
		$visible = 2;
	}
	
	////PEGO EN BASE DE DATOS LA NOTICIA...////
	
	require_once('include/Noticia.php');
	//instancio
	$noticia = new Noticia();
	
	//setea noticia 
	$add = $noticia->setNoticia($titulo,$resumen,$texto,$linkExterno,$fuente,$categoria,$visible,$cita,$tags);
	
	//setea video en galeria 
	if( (!empty($_POST['noticia_video_assign'])) && (!empty($linkExterno)) )
	{
		require_once('include/Video.php');
		$video = new Video();
		// setVideo($description,$videoId,$source,$categoriaId)
		$categoriaVideo = 2; //id referente a noticias en la tabla categoria_video
		$setVideoToGallery = $video->setVideo($titulo,$linkExterno,'youtube',$categoriaVideo); //default youtube
	}

	//getea id de noticia para asociarlo a imagenes y categorias.
	$idNoticiaNueva = $noticia->getLastIdNoticia();

	//setea categoria
	$addcat = $noticia->setCategoriaForNoticia($idNoticiaNueva,$categoria);
	
	//// MOVER ARCHIVOS DE IMAGENES ////
	
	//por cada input que haya... 
	for($i = 0; $i < count($_FILES) ; $i++)
	{
		//nombre genérico en ciclos
		$filesNombre = "noticia_filebutton_" . $i; //el indice del array genérico
		
		//getteo el epigrafe 
		if(!empty($_POST["noticia_filebuttontext_$i"]))
		{
			$epigrafe = mysql_escape_mimic($_POST["noticia_filebuttontext_$i"]);
		}
		else
		{
			$epigrafe = '';
		}
		
		//echo $_FILES[$filesNombre]['name']; echo '<hr>';
		
		//si existe archivo o no está vacio...
		if(!empty($_FILES[$filesNombre]['name']))
		{
			//echo $_FILES[$filesNombre]['name'];
			//echo '<hr>';
			

			//nombre de archivo
			$date = date_create();
			$filename = date_format($date, 'Ymd-His') . '_' . $i ;
			
			//extension
			$temp = explode(".", $_FILES[$filesNombre]["name"]);
			$extension = end($temp);
			
	                $pathDestiny = PATH_IMAGE_UPLOAD .  basename($filename .'.'.$extension); 

			$moving = move_uploaded_file($_FILES[$filesNombre]["tmp_name"],"$pathDestiny");

	                $path = $filename.'.'.$extension;

			//Seteo imagen en la base de datos
			$addimg = $noticia->setImageForNoticia($idNoticiaNueva,$path,$epigrafe);
			//TO DO : 
			//Modificar el metodo setImageForNoticia, para que opcionalmente reciba texto tipo epigrafe
			//getear los POSTS y meterlos en una variable para que los tome el metodo setimagefornoticia
			
			/*
			echo $path;
			echo '<hr>';
			*/
			
		}
	}//for
	
	/*
	//POSIBLE FORMA DE VALIDAR LOS ARCHIVOS
	
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["noticia_filebutton"]["name"]);
	$extension = end($temp);

	$pathDestiny = "admin/files/" . $_FILES["noticia_filebutton"]["name"];

	if ((($_FILES["noticia_filebutton"]["type"] == "image/gif")
	|| ($_FILES["noticia_filebutton"]["type"] == "image/jpeg")
	|| ($_FILES["noticia_filebutton"]["type"] == "image/jpg")
	|| ($_FILES["noticia_filebutton"]["type"] == "image/pjpeg")
	|| ($_FILES["noticia_filebutton"]["type"] == "image/x-png")
	|| ($_FILES["noticia_filebutton"]["type"] == "image/png"))
	&& ($_FILES["noticia_filebutton"]["size"] < 5000000)
	&& in_array($extension, $allowedExts)) {
	  if ($_FILES["noticia_filebutton"]["error"] > 0) {
	    echo "Return Code: " . $_FILES["noticia_filebutton"]["error"] . "<br>";
	  } else {
	    echo "Upload: " . $_FILES["noticia_filebutton"]["name"] . "<br>";
	    echo "Type: " . $_FILES["noticia_filebutton"]["type"] . "<br>";
	    echo "Size: " . ($_FILES["noticia_filebutton"]["size"] / 1024) . " kB<br>";
	    echo "Temp file: " . $_FILES["noticia_filebutton"]["tmp_name"] . "<br>";
	    if (file_exists($pathDestiny)) {
	      echo $_FILES["noticia_filebutton"]["name"] . " already exists. ";
	    } else {
	      //$moving = move_uploaded_file($_FILES["noticia_filebutton"]["tmp_name"],"$pathDestiny");
	      $moving = move_uploaded_file($_FILES["noticia_filebutton"]["tmp_name"],"$pathDestiny");
	    }
	  }
	} else {
	  echo "Invalid file";
	}

	*/
//aca iba el sql 

	if(empty($add))
	{
		//echo '0';
	}
	else
	{
		//header('Location: /admin/noticia-listar.php');
	}
	
	if($preview == 0)
	{
		header('Location: noticia-listar.php');
	}
	else
	{
		//header("Location: /Noticias/preview.php?id=$idNoticiaNueva");		
		//header("Location: http://www.sindicatolafraternidad.org/Noticias/preview.php?id=$idNoticiaNueva");
        $redirect = PREVIEW_PATH . '?id=' . $idNoticiaNueva;
        header("Location:  $redirect");
	}
	
	
}
else
{
	header('Location: noticia-listar.php');
}


?>
