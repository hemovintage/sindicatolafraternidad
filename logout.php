<?php
//iniciamos la sesión 
session_name("loginUsuario"); 
session_start();
session_unset(); // destruyo la sesión
session_destroy(); // destruyo la sesión
//var_dump($_SESSION);
header("Location: index.php"); //envío al usuario a la pag. de autenticación
?>