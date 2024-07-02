<?php

require_once('Conector.php');

class Queries{
    
    private $_newBase;
    public $rs = '';
    
    public function __construct(){
        //instancio el objeto conector en una variable
        $this->_newBase = new Conector();
        //establezco en la instancia los datos para que se conecte a DB
        $this->_newBase->setConector();

    }//__construct


    public function execSelect($query){
        
        $datos = array();
        
        if($rs = $this->_newBase->getConector()->query($query)){
            
            if($rs){
                while($row = $rs->fetch_assoc()){
                    $datos[] = $row;
                }//while
            }//if
        }else{
            //aca podria devolver un array con indice 0 que contenga el value error
            echo 'hubo un error en el query';
            echo '<br>';            
            echo $this->_newBase->getConector()->error;
        }
        return $datos;
        
        $this->_newBase->getConector()->close();
        
    }
    
    public function execQuery($query){
        
        //$query = 'DELETE FROM ' . $tabla . ' WHERE ' . $condicion;
        

        if($rs = $this->_newBase->getConector()->query($query)){

//            echo 'SE BORRO: <br>' . $query;

            return true;

        }else{

//            echo 'NO SE BORRO: <br>' . $query;
//            echo '<br>';            
            echo $this->_newBase->getConector()->error;

        }//if
        
        //cierra conector
        $this->_newBase->getConector()->close();
        
    }
    

    public function execInsert($query){

        //$query = 'INSERT INTO '. $tabla . ' ('. $campos . ') VALUES ('. $valores .')';

        if($rs = $this->_newBase->getConector()->query($query)){
            //insert success
            
            //devuelve el ID del ultimo insert hecho
            return $this->_newBase->getConector()->insert_id;

        }else{
            //insert failed
            echo $this->_newBase->getConector()->error;
        }

        //cierra conector
        $this->_newBase->getConector()->close();
        
    }//insert()

   
}

?>