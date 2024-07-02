<?php

require_once('Queries.php');
require_once('constants.php');

class Noticia{
    
    private $_consulta;
    
    public function __construct(){
        //instancio el objeto Querie        
        $this->_consulta = new Queries();
        
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
                            REPLACE( noticia_imagen.path, '" . FULL_PATH_SITE_IMAGES_UPLOAD_OLD . "', '' ) as relative_path,
                            concat('/Noticias/index.php?id=',noticia.id) as url,
                            noticia.url_externa,
                            noticia.cita,
							noticia.tags
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
                            noticia_imagen.isDeleted as imagen_deleted,
                            REPLACE( noticia_imagen.path, '" . FULL_PATH_SITE_IMAGES_UPLOAD_OLD. "', '' ) as relative_path,
                            concat('/Noticias/index.php?id=',noticia.id) as url,
                            noticia.url_externa,
                            noticia.visible,
                            noticia.cita
                    from noticia
                    LEFT JOIN noticia_imagen ON (noticia.id = noticia_imagen.noticia_id AND noticia_imagen.tipo = 1)
                    WHERE noticia.is_deleted = 0
					AND (noticia.visible = 1 OR noticia.visible = 0)
					GROUP BY noticia.id
                    order by noticia.fecha desc
                    limit $cantidad ";
 
        $resultado = $this->_consulta->execSelect($query);

        return $resultado;                    

    }
    
	public function getImagenByNoticiaId($id)
	{
		$id = (int)$id;
		
		$query = "	SELECT  id,
                        path,
                        REPLACE(path, '" . FULL_PATH_SITE_IMAGES_UPLOAD_OLD . "', '' ) as relative_path,
                        noticia_id,
                        orden,
                        visible,
                        tipo,
                        descripcion,
                        isDeleted
                FROM noticia_imagen
					      WHERE noticia_id = $id
                AND isDeleted = 0 
					      AND visible = 1
					      ORDER BY orden";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;    
		
	}
    
    public function setNoticia($titulo,$resumen,$texto,$linkExterno="",$fuente="",$categoria,$visible=1,$cita=0,$tags="")
    {
        $query = "  INSERT INTO noticia 
                    (
                        titulo,
                        resumen,
                        texto,
                        fecha,
                        fuente,
                        url_externa,
                        visible,
                        cita,
						tags
                    ) 
                    VALUES 
                    (
                        '$titulo', 
                        '$resumen',
                        '$texto',
                        CURRENT_TIMESTAMP,
                        '$fuente',
                        '$linkExterno',
                        '$visible',
                        '$cita',
						'$tags'
                    )";
        
        return $this->_consulta->execInsert($query);
    }
    
    public function updateNoticia($idNoticia,$titulo,$resumen,$texto,$linkExterno="",$fuente="",$visible = 0,$cita=0,$actualizar_fecha=0,$tags="")
    {
        $query = "  UPDATE noticia SET
                                    titulo = '$titulo',
                                    resumen = '$resumen',
                                    texto = '$texto',
                                    fuente = '$fuente',
                                    url_externa = '$linkExterno',
									visible = '$visible',
                                    cita = '$cita',
									tags = '$tags' ";
		if($actualizar_fecha)
			$query .= ", fecha = now() ";

        $query .= "WHERE id = $idNoticia";

        return $this->_consulta->execQuery($query);
    }




    public function getLastIdNoticia()
    {
        $query = "  select  noticia.id
                    from noticia
                    order by noticia.fecha desc
                    limit 1";


        $resultado = $this->_consulta->execSelect($query);
        
        $id = $resultado[0]['id']; 
        
        return $id;
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
   
    public function unsetImageForNoticia($idImagen)
    {
        $idImagen = (int)$idImagen;

        $query = "UPDATE noticia_imagen SET isDeleted = 1 WHERE id = $idImagen";

        $resultado = $this->_consulta->execQuery($query);
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
        

        
    public function changeEstadoNoticiaById($idNoticia,$visible)
    {

        $idNoticia = (int)$idNoticia;
        $visible = (int)$visible;

        $query = "UPDATE noticia SET visible = '".$visible."' WHERE id = $idNoticia";

        $resultado = $this->_consulta->execQuery($query);

    }

    public function eraseNoticiaById($idNoticia)
    {

        $idNoticia = (int)$idNoticia;

        $query = "UPDATE noticia SET is_deleted = '1', visible = '0' WHERE id = $idNoticia";

        $resultado = $this->_consulta->execQuery($query);

    }

    
}


?>
