<?php

require_once('Queries.php');

class Categoria{
    
    private $_consulta;
    
    public function __construct(){
        //instancio el objeto Querie        
        $this->_consulta = new Queries();
        
    }
    
    /* EN FRONT ! */    
    public function getAllCategoriasAvailables(){
    
        $query  = "SELECT   categoria.id, ";
        $query .= "         categoria.nombre, ";
        $query .= "         count(categoria_noticia.id) as cantidad ";
        $query .= "from categoria ";
        $query .= "LEFT JOIN categoria_noticia ON categoria_noticia.categoria_id = categoria.id ";
        $query .= "WHERE categoria.visible = 1 ";
        $query .= "GROUP BY categoria.id ";
        $query .= "order by categoria.orden ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;        
       
    }
    /*
    public function getCategoriaById($id){
        
        $objeto = mysql_escape_string($objeto);
        
        $query .= "SELECT * FROM banner ";
        $query .= "WHERE objeto = '$objeto' ";
        $query .= "AND visible = 1 ";
        $query .= "ORDER by orden ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;        
       
    }
    */
    
    
}


?>