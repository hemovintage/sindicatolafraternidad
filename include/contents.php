<?php

require_once('include/Objeto.php');

//instancio clase Objeto
$objeto = new Objeto();

//si [p] NO ESTA vacio ...
if(!empty($_REQUEST['p']))
{
    //llamo al objeto especifico por su campo 'nombre'
    $content = $objeto->getObjeto($_REQUEST['p']);
    
    //si $content viene vacio le pongo un valor por default 
    if(empty($content))
    {
        $content = $objeto->getObjeto('inicio');
    }
    
}
else
{
    //DEFAULT : llamo al objeto especifico por su campo 'nombre' default
    $content = $objeto->getObjeto('inicio');
}

/* En esta instancia ya tengo contenido en la variable $content */

//instancio los valores traidos de base de datos en variables simples
$content_id = $content[0]['id'];
$content_fullname = $content[0]['fullname'];
$content_name = $content[0]['name'];
$content_file = $content[0]['file']; // el nombre del objeto php
$content_logo = $content[0]['logo'];
$content_image = $content[0]['image'];
$content_active = $content[0]['active'];


//compruebo que existe la imagen (contenido), caso contrario le seteo una default
if(!file_exists('img/'.$content_image))
{
    $content_file = 'image-mainmenu-dummy.gif';     
}

//compruebo que existe el objeto (contenido), caso contrario le seteo un 404 personalizado
if(!file_exists('objetos/'.$content_file))
{
    $content_file = '404.php';     
}




?>