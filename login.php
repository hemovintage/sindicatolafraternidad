<?php

session_name("loginUsuario");
session_start();

require_once('include/Usuario.php');

$user = $_POST['username'];
$pass = $_POST['password'];

$usuario = new Usuario();
$login = $usuario->getUsuario($user,$pass);


if(empty($login))
{
	$_SESSION["error"]++;	
	header("Location: /index.php?errno=1");
}
else
{
    $nivel = $usuario->getUsuarioNivelByUserAndPass($user,$pass);
    $_SESSION["nivel"]= $nivel['nivel'];
	$_SESSION["autentificado"]= "SI";
	//$_SESSION["user"]= $row["id_usuario"];
	header("Location: noticia-listar.php");
	//$_SESSION["usuario"]=$row["id_usuario"];
	//$_SESSION["nombre"]=$row["nombre"] . " " . $row["apellido"];
	//$_SESSION["sector"]= $row["sector"];

}
?>