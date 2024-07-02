<?php


class Conector{
    
    private $_conexion;
   
    public function __construct(){        

    }
    
    
    
    //public function setConector($host='localhost',$user='root',$pass='',$db='ladobleayuda'){    
    //public function setConector($host='190.228.129.12',$user='uv025222_dev',$pass='vida1234',$db='fraternidad'){
    //public function setConector($host='200.68.105.12',$user='uv025222_v2',$pass='vida1234',$db='fraternidad_version2'){
    //public function setConector($host='200.68.105.12',$user='uv025222_new',$pass='vida1234',$db='fraternidad_v2'){
    public function setConector($host='localhost',$user='uv025222_frate18',$pass='FR4T3RN1D4D2018',$db='uv025222_fraternidad2018'){
       
        $this->_conexion = @new mysqli($host,$user,$pass,$db);

        if (mysqli_connect_errno()) {
            
            printf("<strong>FALLO CONEXION:</strong> %s", mysqli_connect_error());
            
            exit();
            
        }else{
            
            mysqli_set_charset($this->_conexion, "utf8");

//            echo 'SE CONECTO<br />';
            return $this->_conexion;
            
        }//if
        
    }//set

    
    
    
    
    public function getConector(){
        
        mysqli_set_charset($this->_conexion, "utf8");
        
        return $this->_conexion;

    }//get
    
}
?>
