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

	$idNoticia = mysql_escape_mimic($_POST['noticia_id']);
	$titulo = mysql_escape_mimic($_POST['noticia_titulo']);
	$resumen = mysql_escape_mimic($_POST['noticia_resumen']);
	$texto = mysql_escape_mimic($_POST['noticia_cuerpo']);
	$linkExterno = mysql_escape_mimic($_POST['noticia_linkexterno']);
	$fuente = mysql_escape_mimic($_POST['noticia_fuente']);
	$categoria = mysql_escape_mimic($_POST['noticia_categoria']);
	$preview = $_POST['noticia_preview']; // 0 : modificar - guardar / 1 : previsualizar
	$visible = 0; // 0 : oculto / 1 : publicado / 2: modo preview 
    $cita = $_POST['noticia_cita'];
	$actualizar_fecha = $_POST['noticia_actualizar_fecha'];
	$tags = $_POST['noticia_tags'];
	
	if($preview == 0) //
	{
		$visible = 0;//se va a ocultar pero se va a ver enb la lista de admin...
	}
	else if($preview == 1)
	{
		$visible = 2;//se tilda como modo preview
	}

	require_once('include/Noticia.php');

	$noticia = new Noticia();

	//setea noticia 
	$edit = $noticia->updateNoticia($idNoticia,$titulo,$resumen,$texto,$linkExterno,$fuente,$visible,$cita,$actualizar_fecha,$tags);

	//setea imagen
	//$addimg = $noticia->setImageForNoticia($idNoticiaNueva,$path);
    
    
    
    
    

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
			//$pathDestiny = '/www/docs/sindicatolafraternidad.org/public_html/images/upload/' . basename($filename .'.'.$extension); //PRODUCCION
			//$pathDestiny = '/wamp/www/images/upload/' . basename($filename.'.'.$extension); //LOCALHOST
			
			//$moving = move_uploaded_file($_FILES["noticia_filebutton"]["tmp_name"],"$pathDestiny");
			$moving = move_uploaded_file($_FILES[$filesNombre]["tmp_name"],"$pathDestiny");
            $path = $filename.'.'.$extension;
			//$path = "http://www.sindicatolafraternidad.org/images/upload/".$filename.'.'.$extension; //OLD
			//$path = "/images/upload/".$filename.'.'.$extension; //GENERIC
			
			//Seteo imagen en la base de datos
			$addimg = $noticia->setImageForNoticia($idNoticia,$path,$epigrafe);
			//TO DO : 
			//Modificar el metodo setImageForNoticia, para que opcionalmente reciba texto tipo epigrafe
			//getear los POSTS y meterlos en una variable para que los tome el metodo setimagefornoticia
			
			/*
			echo $path;
			echo '<hr>';
			*/
			
		}
	}//for
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

	//setea categoria
	$editcat = $noticia->updateCategoriaForNoticia($idNoticia,$categoria);

	if($preview == 0)
	{
		header('Location: noticia-listar.php');
	}
	else
	{
//		header("Location: /Noticias/preview.php?id=$idNoticia"); 		
//		header("Location: http://www.sindicatolafraternidad.org/Noticias/preview.php?id=$idNoticia");
        $redirect = PREVIEW_PATH . '?id=' . $idNoticia;
        header("Location:  $redirect");
	}
	/*
	if(empty($edit))
	{
		echo '0';
	}
	else
	{
		//header('Location: /admin/noticia-listar.php');
	}*/
}
else
{
	header('Location: noticia-listar.php');
}


?>
