<?php

require_once('Queries.php');
require_once('constants.php');

class NoticiaSlider{
    
    private $_consulta;
    
    public function __construct(){
        //instancio el objeto Querie        
        $this->_consulta = new Queries();
        
    }
    
    /* EN FRONT ! */    
    public function getNoticiaById($idNoticia){
        
        $idNoticia = (int)$idNoticia;
        
        $query = "select    noticia_slider.id,
                            noticia_slider.titulo,
                            noticia_slider.resumen,
                            noticia_slider.categoria,
                            noticia_slider.texto,
                            DATE_FORMAT(noticia_slider.fecha,'%b %d, %Y') as fecha,
                            noticia_slider.fuente,
                            noticia_slider_imagen.path,
                            REPLACE( noticia_slider_imagen.path, '" . FULL_PATH_SITE_IMAGES_UPLOAD_OLD . "', '' ) as relative_path,
                            concat('/Noticias/index.php?id=',noticia_slider.id) as url,
                            noticia_slider.is_video,
                            noticia_slider.url_externa
                    from noticia_slider ";
        $query .= "LEFT JOIN noticia_slider_imagen ON (noticia_slider.id = noticia_slider_imagen.noticia_id AND noticia_slider_imagen.tipo = 1) ";
        $query .= "WHERE noticia_slider.id = '$idNoticia' ";
           
        $query .= "LIMIT 1 ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;        
       
    }

    public function getLatestNoticias($cantidad = 3)
    {

        $cantidad = (int)$cantidad;

        $query = "  select  noticia_slider.id,
                            noticia_slider.titulo,
                            noticia_slider.resumen,
                            DATE_FORMAT(noticia_slider.fecha,'%b %d %Y') as fecha,
                            noticia_slider_imagen.path,
                            noticia_slider_imagen.isDeleted as imagen_deleted,
                            REPLACE( noticia_slider_imagen.path, '" . FULL_PATH_SITE_IMAGES_UPLOAD_OLD. "', '' ) as relative_path,
                            concat('/Noticias/index.php?id=',noticia_slider.id) as url,
                            noticia_slider.url_externa,
                            noticia_slider.is_video,
                            noticia_slider.visible
                    from noticia_slider
                    LEFT JOIN noticia_slider_imagen ON (noticia_slider.id = noticia_slider_imagen.noticia_id AND noticia_slider_imagen.tipo = 1 AND noticia_slider_imagen.isDeleted = 0)
                    WHERE noticia_slider.is_deleted = 0
					AND (noticia_slider.visible = 1 OR noticia_slider.visible = 0)
					GROUP BY noticia_slider.id
                    order by noticia_slider.fecha desc
                    limit $cantidad ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;                    

    }

    
	public function getImagenByNoticiaId($id,$cantidad=0)
	{
		$id = (int)$id;
		$cantidad = (int)$cantidad;
		
		$query = "	SELECT  id,
                            path,
                            REPLACE(path, '" . FULL_PATH_SITE_IMAGES_UPLOAD_OLD . "', '' ) as relative_path,
                            noticia_id,
                            orden,
                            visible,
                            tipo,
                            descripcion,
                            isDeleted
                    FROM noticia_slider_imagen
					WHERE noticia_id = $id
                    AND isDeleted = 0 
					AND visible = 1 ";
					
  		$query .= "ORDER BY orden ";
                    
        if($cantidad)
            $query .= "LIMIT $cantidad ";
        
        $resultado = $this->_consulta->execSelect($query);

        return $resultado;    
		
	}
    
    public function setNoticia($titulo,$resumen,$texto,$linkExterno="",$fuente="",$categoria,$visible=1,$isVideo=0)
    {
        $query = "  INSERT INTO noticia_slider 
                    (
                        titulo,
                        resumen,
                        categoria,
                        texto,
                        fecha,
                        fuente,
                        url_externa,
                        visible,
                        is_video
                    ) 
                    VALUES 
                    (
                        '$titulo', 
                        '$resumen',
                        '$categoria',
                        '$texto',
                        CURRENT_TIMESTAMP,
                        '$fuente',
                        '$linkExterno',
                        '$visible',
                        '$isVideo'
                    )";
        
        return $this->_consulta->execInsert($query);
    }
    
    public function updateNoticia($idNoticia,$titulo,$categoria,$resumen,$texto,$linkExterno="",$fuente="",$visible = 0,$actualizar_fecha=0,$isVideo=0)
    {
        $query = "  UPDATE noticia_slider SET
                                    titulo = '$titulo',
                                    resumen = '$resumen',
                                    categoria = '$categoria',
                                    texto = '$texto',
                                    fuente = '$fuente',
                                    url_externa = '$linkExterno',
                                    is_video = '$isVideo',
									visible = '$visible' ";
		if($actualizar_fecha)
			$query .= ", fecha = now() ";

        $query .= "  WHERE id = $idNoticia";

        return $this->_consulta->execQuery($query);
    }




    public function getLastIdNoticia()
    {
        $query = "  select  noticia_slider.id
                    from noticia_slider
                    order by noticia_slider.fecha desc
                    limit 1";


        $resultado = $this->_consulta->execSelect($query);
        
        $id = $resultado[0]['id']; 
        
        return $id;
    }

    public function setImageForNoticia($idNoticia,$archivo,$epigrafe="",$width="",$height="",$mime="")
    {
        $query = "  INSERT INTO noticia_slider_imagen 
                    (
                        path,
                        noticia_id,
						descripcion,
                        width,
                        height,
                        mime
                    ) 
                    VALUES 
                    (
                        '$archivo',
                        '$idNoticia',
						'$epigrafe',
                        '$width',
                        '$height',
                        '$mime'
                    )";
        
        return $this->_consulta->execInsert($query);
    }
   

        /*
    public function updateCategoriaForNoticia($idNoticia,$idCategoria)
    {

        $idNoticia = (int)$idNoticia;
        $idCategoria = (int)$idCategoria;

        $query = "UPDATE categoria_noticia SET categoria_id = '".$idCategoria."' WHERE noticia_id = $idNoticia";

        $resultado = $this->_consulta->execQuery($query);

    }
    */
/*
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
    */    
    public function unsetImageForNoticia($idImagen)
    {
        $idImagen = (int)$idImagen;

        $query = "UPDATE noticia_slider_imagen SET isDeleted = 1 WHERE id = $idImagen";

        $resultado = $this->_consulta->execQuery($query);
    }
        
    public function changeEstadoNoticiaById($idNoticia,$visible)
    {

        $idNoticia = (int)$idNoticia;
        $visible = (int)$visible;

        $query = "UPDATE noticia_slider SET visible = '".$visible."' WHERE id = $idNoticia";

        $resultado = $this->_consulta->execQuery($query);

    }

    public function eraseNoticiaById($idNoticia)
    {

        $idNoticia = (int)$idNoticia;

        $query = "UPDATE noticia_slider SET is_deleted = '1', visible = '0' WHERE id = $idNoticia";

        $resultado = $this->_consulta->execQuery($query);

    }

    
}


?>
