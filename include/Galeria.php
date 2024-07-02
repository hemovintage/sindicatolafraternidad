<?php

require_once('Queries.php');

class Galeria{
    
    private $_consulta;
    
    public function __construct(){
        //instancio el objeto Querie        
        $this->_consulta = new Queries();
        
    }
    
    /* EN FRONT ! */    
    public function getGaleriaByObjeto($objeto){
        
        $objeto = mysql_escape_string($objeto);
        
        $query .= "SELECT * FROM galeria ";
        $query .= "WHERE objeto = '$objeto' ";
        $query .= "ORDER by orden ";

        $resultado = $this->_consulta->execSelect($query);

        return $resultado;        
       
    }
    
    public function CheckExistGaleriaByObjeto($objeto){

        $objeto = mysql_escape_string($objeto);
        
        $query .= "SELECT COUNT(*) AS cantidad ";
        $query .= "FROM galeria ";
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



/*    
    public function getAllConsultas(){
        
        $query  = "SELECT 	consulta.id, ";
        $query .= "         consulta.caso AS caso_id, ";
        $query .= "	        caso.nombre AS caso_nombre, ";
        $query .= "	        caso.expediente AS caso_expediente, ";
        $query .= "	        consulta.cliente AS cliente_id, ";
        $query .= "	        CONCAT(cliente.nombre,' ',cliente.apellido) AS cliente_nombre, ";
        $query .= "         cliente.dni AS cliente_dni, ";
        $query .= "	        consulta.consulta, ";
        $query .= "	        consulta.respuesta, ";
        $query .= "	        consulta.fecha ";
        
        $query .= "FROM consulta ";
        
        $query .= "LEFT JOIN cliente ON consulta.cliente = cliente.id ";
        $query .= "LEFT JOIN caso ON consulta.caso = caso.id ";
        //$query .= "ORDER BY fecha,cliente_nombre ";
        $query .= "ORDER BY caso_expediente,fecha ";
        
        $resultado = $this->_consulta->execSelect($query);

        return $resultado;
        
    }
    
    public function insertarConsulta($idCaso,$idCliente,$respuesta,$fecha){

        $idCaso = (int)$idCaso;        
        $idCliente = (int)$idCliente;
        //$consulta = mysql_escape_string($consulta);
        $respuesta = mysql_escape_string($respuesta);
        $fecha = $fecha;
        
        $query  = "INSERT INTO consulta ";
        //$query .= "(caso,cliente,consulta,respuesta,fecha) "; 
        $query .= "(caso,cliente,respuesta,fecha) ";
        $query .= "VALUES ";
        //$query .= "('$idCaso','$idCliente','$consulta','$respuesta','$fecha') ";
        $query .= "('$idCaso','$idCliente','$respuesta','$fecha') ";

        $resultado = $this->_consulta->execInsert($query);

        return $resultado;      
    }
    
    public function editarConsulta($id,$idCaso,$idCliente,$respuesta,$fecha){
        
        $id = (int)$id;
        $idCaso = (int)$idCaso;        
        $idCliente = (int)$idCliente;
        //$consulta = mysql_escape_string($consulta);
        $respuesta = mysql_escape_string($respuesta);
        $fecha = $fecha;
        
        $query .= "UPDATE consulta  ";
        $query .= "SET ";
        $query .= "    caso = $idCaso, ";
        $query .= "    cliente = $idCliente, ";
        //$query .= "    consulta = '$consulta', ";
        $query .= "    respuesta = '$respuesta', ";
        $query .= "    fecha = '$fecha' ";
        $query .= "WHERE ( id = $id ) ";
        
        $resultado = $this->_consulta->execQuery($query);

        return $resultado;

    }
    
    
    public function borrarConsulta($idConsulta){
        
        $idConsulta = (int)$idConsulta;
        
        $query  = "DELETE FROM consulta ";
        $query .= "WHERE (id = $idConsulta) ";
        
        $resultado = $this->_consulta->execQuery($query);

        return $resultado;
          
    }
*/   

 
    
    
    
}


?>