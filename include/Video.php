<?php

require_once('Queries.php');

class Video{
    
    private $_consulta;
    
    public function __construct(){
        //instancio el objeto Querie        
        $this->_consulta = new Queries();
        
    }
	
	
	//TODO : Filtrar por categoria , por borrados , por source , y paginar con ajax // imagen por curl
	public function getLatestVideos($cantidad=20)
	{
       $cantidad = (int)$cantidad;
	   
        $query = "	SELECT 	video.id,
							video.description AS titulo,
							video.source,
							video.video_id,
							video.isDeleted,
							categoria_video.descripcion AS categoria,
							video.visible
					FROM video
					JOIN categoria_video ON categoria_video.id = video.categoria_id
					WHERE 1=1
					AND video.isDeleted = 'N'
					AND video.categoria_id != 1 
					ORDER BY video.date DESC ";
        
           
        $query .= "LIMIT $cantidad ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;   
	
	}
    
    /* EN FRONT ! */    
    public function getNoticiaById($idNoticia){
        
        $idNoticia = (int)$idNoticia;
        
        $query = "select    noticia.id,
                            noticia.titulo,
                            noticia.resumen,
                            noticia.texto,
                            DATE_FORMAT(noticia.fecha,'%b %d, %Y') as fecha,
                            noticia.fuente,
                            noticia_imagen.path,
                            concat('/Noticias/index.php?id=',noticia.id) as url,
                            noticia.url_externa
                    from noticia ";
        $query .= "LEFT JOIN noticia_imagen ON (noticia.id = noticia_imagen.noticia_id AND noticia_imagen.tipo = 1) ";
        $query .= "WHERE noticia.id = '$idNoticia' ";
           
        $query .= "LIMIT 1 ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;        
       
    }

    public function getLatestNoticias($cantidad = 3)
    {

        $cantidad = (int)$cantidad;

        $query = "  select  noticia.id,
                            noticia.titulo,
                            noticia.resumen,
                            DATE_FORMAT(noticia.fecha,'%b %d %Y') as fecha,
                            noticia_imagen.path,
                            concat('/Noticias/index.php?id=',noticia.id) as url,
                            noticia.url_externa,
                            noticia.visible
                    from noticia
                    LEFT JOIN noticia_imagen ON (noticia.id = noticia_imagen.noticia_id AND noticia_imagen.tipo = 1)
                    WHERE noticia.is_deleted = 0
					AND (noticia.visible = 1 OR noticia.visible = 0)
                    order by noticia.fecha desc
                    limit $cantidad ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;                    

    }


    public function setNoticia($titulo,$resumen,$texto,$linkExterno="",$fuente="",$categoria,$visible=1)
    {
        $query = "  INSERT INTO noticia 
                    (
                        titulo,
                        resumen,
                        texto,
                        fecha,
                        fuente,
                        url_externa,
                        visible
                    ) 
                    VALUES 
                    (
                        '$titulo', 
                        '$resumen',
                        '$texto',
                        CURRENT_TIMESTAMP,
                        '$fuente',
                        '$linkExterno',
                        '$visible'
                    )";
        
        return $this->_consulta->execInsert($query);
    }
	
	public function getAllCategorias()
	{
		$query = "  SELECT 	id,descripcion 
					FROM categoria_video
					WHERE isDeleted = 'N'
					AND id != 1 ";

        $resultado = $this->_consulta->execSelect($query);
		
        return $resultado;
		
	}

	
    public function updateVideoHome($id,$titulo,$videoId,$source)
    {
        $query = "  UPDATE video SET
									description = '$titulo',
                                    video_id = '$videoId',
                                    source = '$source'
                    WHERE id = $id";
					
        return $this->_consulta->execQuery($query);
    }
	
    public function setVideo($description,$videoId,$source,$categoriaId)
    {
        $query = "  INSERT INTO video 
                    (
                        video_id,
                        source,
						description,
						categoria_id
                    ) 
                    VALUES 
                    (
                        '$videoId',
                        '$source',
						'$description',
						'$categoriaId'
                    )";
        
        return $this->_consulta->execInsert($query);
    }

	public function updateVideo($id,$description,$videoId,$source,$categoriaId)
	{
		$id = (int)$id;
        $categoriaId = (int)$categoriaId;

        $query = "	UPDATE video 
					SET video_id = '".$videoId."',
						source = '".$source."',
						description = '".$description."',
						categoria_id = '".$categoriaId."'
					WHERE id = $id";

        $resultado = $this->_consulta->execQuery($query);
	}
	
	
    public function getVideoById($id)
    {
        $query = "  select  *
                    from video
                    where id = $id
                    limit 1";

        $resultado = $this->_consulta->execSelect($query);
		
        return $resultado;
    }

    public function getVideoHome($id)
    {
        $query = "  select  *
                    from video
                    where id = $id
                    limit 1";

        $resultado = $this->_consulta->execSelect($query);
		
        return $resultado;
    }

    public function setImageForNoticia($idNoticia,$archivo,$epigrafe="")
    {
        $query = "  INSERT INTO noticia_imagen 
                    (
                        path,
                        noticia_id,
						descripcion
                    ) 
                    VALUES 
                    (
                        '$archivo',
                        '$idNoticia',
						'$epigrafe'
                    )";
        
        return $this->_consulta->execInsert($query);
    }
   

        
    public function updateCategoriaForNoticia($idNoticia,$idCategoria)
    {

        $idNoticia = (int)$idNoticia;
        $idCategoria = (int)$idCategoria;

        $query = "UPDATE categoria_noticia SET categoria_id = '".$idCategoria."' WHERE noticia_id = $idNoticia";

        $resultado = $this->_consulta->execQuery($query);

    }

    public function setCategoriaForNoticia($idNoticia,$idCategoria)
    {

        $query = "  INSERT INTO categoria_noticia 
                    (
                        categoria_id,
                        noticia_id
                    ) 
                    VALUES 
                    (
                        '$idCategoria', 
                        '$idNoticia'
                    )";
        
        return $this->_consulta->execInsert($query);
    }
        

        
    public function changeEstadoVideoById($id,$visible)
    {

        $id = (int)$id;
        //$visible = (int)$visible;

        $query = "UPDATE video SET visible = '".$visible."' WHERE id = $id";

        $resultado = $this->_consulta->execQuery($query);

    }

    public function eraseVideoById($id)
    {

        $id = (int)$id;

        $query = "UPDATE video SET isDeleted = 'Y', visible = 'N' WHERE id = $id";

        $resultado = $this->_consulta->execQuery($query);

    }

	public function getThumb($id,$source)
	{
		if($source == 'youtube')
		{
			//$path = 'http://ytpath';
			$path = "http://img.youtube.com/vi/". $id ."/0.jpg";
			
		}
		else if($source == 'vimeo')
		{
			$imgid = $id;
			
			$file = "http://vimeo.com/api/v2/video/$imgid.php"; //file dinamico que retorna array
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $file);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//le indico que lo devuelva en una variable, o q simplemente returnée
			$hash = curl_exec($curl);
			
			curl_close($curl);
			
			$hash = unserialize($hash); //convierto en array porque sino me lo toma como string...
			
			//$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php")); //vieja forma
			
			$path = $hash[0]['thumbnail_large'];   //tomo la imagen del index del array 
		}
		else
		{
			$path = 'http://noImagePath'; 
		}
		
		return $path;
	}
	
    
}


?>