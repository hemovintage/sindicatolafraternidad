<?php

require_once('Queries.php');

class Usuario{
    
    private $_consulta;
    
    public function __construct(){
        //instancio el objeto Querie        
        $this->_consulta = new Queries();
        
    }
    
    /* EN FRONT ! */
    /**
     * Verifica si existe otro usuario haciendo count en el array devuelto por la consulta. 
     * @return boolean
     * */  
     /*  
    public function existeUsuarioRegistradoPorEmail($mail){
        
        $mail = mysql_escape_string($mail);
        
        $query  = "SELECT mail FROM newsletter ";
        $query .= "WHERE mail = '$mail' ";

        $resultado = $this->_consulta->execSelect($query);
        
        if(count($resultado) != 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    */
    
    /**
     * Inserta usuario a base de datos, tomando ademas la ip de servidor y el timestamp de la base
     * @return resource(array) / false
     */
    /*
    public function agregarUsuario($user,$pass){
        
        $mail = mysql_escape_string($mail);
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $query = " INSERT INTO newsletter (mail, ip, date) VALUES ('$mail', '$ip',CURRENT_TIMESTAMP)";
        
        return $this->_consulta->execQuery($query);
        
    }
    */

   /**
     * Verifica si existen banners relacionados al objeto. En caso de no existir no arma el html
     * @return boolean
    */
    public function getUsuario($user,$pass){

        //$objeto = mysql_escape_string($objeto);
        
        $query = "";

        $query .= "SELECT COUNT(*) AS cantidad ";
        $query .= "FROM usuario ";
        $query .= "WHERE user = '$user' ";
        $query .= "AND password = '$pass' ";
        $query .= "AND visible = 1 ";

        //echo $query;

        $resultado = $this->_consulta->execSelect($query);
        
        $check = $resultado[0]['cantidad']; 
        
        if($check == 0){
            return false;
        }
        else
        {
            return true;    
        }
        
    }
    
    public function getUsuarioNivelByUserAndPass($user,$pass){

        //$objeto = mysql_escape_string($objeto);
        
        $query = "";

        $query .= "SELECT nivel ";
        $query .= "FROM usuario ";
        $query .= "WHERE user = '$user' ";
        $query .= "AND password = '$pass' ";

        $resultado = $this->_consulta->execSelect($query);
        
        return $resultado[0];
        
    }


    /**
     * Verifica si existen banners relacionados al objeto. En caso de no existir no arma el html
     * @return boolean
    */
    /*
    public function CheckExistBannerByObjeto($objeto){

        $objeto = mysql_escape_string($objeto);
        
        $query .= "SELECT COUNT(*) AS cantidad ";
        $query .= "FROM banner ";
        $query .= "WHERE objeto = '$objeto' ";

        $resultado = $this->_consulta->execSelect($query);
        
        $check = $resultado[0]['cantidad']; 
        
        if($check == 0){
            return false;
        }
        else
        {
            return true;    
        }
        
    }
    */
    
    
    
}


?>