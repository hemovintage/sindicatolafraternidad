<?php

require_once('Queries.php');

class Categoria{
    
    private $_consulta;
    
    public function __construct(){
        //instancio el objeto Querie        
        $this->_consulta = new Queries();
        
    }
    
    /* EN FRONT ! */    
    public function getAllCategoria(){
        
        $query .= "SELECT * FROM categoria ";
        $query .= "WHERE visible = 1 ";    
        $query .= "ORDER by orden ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;        
       
    }
    
}


?>