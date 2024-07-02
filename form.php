<?php 
require_once('header.php'); 


/* CATEGORIAS */

require_once('include/Categoria.php');

$objetoCategoria = new Categoria();

$getCategoria = $objetoCategoria->getAllCategoriasAvailables();

?>
<form enctype="multipart/form-data" action="noticia-post.php" method="POST">
<form enctype="multipart/form-data" class="form-horizontal" style="text-align:center;" action="noticia-post.php" >
		
	<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
	Choose a file to upload: <input name="noticia-file" type="file" /><br />
	<input type="submit" value="Upload File" />
</form>