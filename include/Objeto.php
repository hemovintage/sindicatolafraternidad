<?php

require_once('Queries.php');

class Objeto{
    
    private $_consulta;
    
    public function __construct(){
        //instancio el objeto Querie        
        $this->_consulta = new Queries();
        
    }
    
    /* EN FRONT ! */    
    public function getObjeto($name){
        
        $name = mysql_escape_string($name);
        
        $query .= "SELECT * FROM objeto ";
        $query .= "WHERE name = '$name' ";
        $query .= "LIMIT 1 ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;        
       
    }



 
    
    
    
}


?>