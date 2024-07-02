<?php
require_once('auth.php');//valida session
?>
  	<?php 
	if(empty($_REQUEST['id']))
	{
		header('Location: /admin/noticia-listar.php');
	}
	else
	{
		$noticiaId = $_REQUEST['id'];
	}

  	require_once('header.php'); 

	/* NOTICIAS */


	require_once('include/Noticia.php');

	$objetoNoticia = new Noticia();

	$getNoticia = $objetoNoticia->getNoticiaById($noticiaId);

	/* CATEGORIAS */

	require_once('include/Categoria.php');

	$objetoCategoria = new Categoria();

	$getCategoria = $objetoCategoria->getAllCategoriasAvailables();


  	?>
	<!--<form class="form-horizontal" style="text-align:center;">-->
	<form enctype="multipart/form-data" class="form-horizontal" style="text-align:left;" action="noticia-post-edit.php" method="POST" >
	
		<fieldset>
			<!-- Form Name -->
			<legend>Editar Noticia</legend>

				<input id="noticia_id" name="noticia_id" value="<?php echo $getNoticia[0]['id']; ?>" type="hidden" />
				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_titulo">Titulo</label>  
				  <div class="col-md-4">
				  <input id="noticia_titulo" value="<?php echo $getNoticia[0]['titulo']; ?>" name="noticia_titulo" placeholder="" class="form-control input-md" required="" type="text">
				    
				  </div>
				</div>

				<!-- Textarea -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_resumen">Resumen</label>
				  <div class="col-md-4">                     
				    <textarea class="form-control" id="noticia_resumen" name="noticia_resumen"><?php echo $getNoticia[0]['resumen']; ?></textarea>
				  </div>
				</div>

				<!-- Textarea -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_cuerpo">Texto</label>
				  <div class="col-md-4">                     
				    <textarea class="jqte-test form-control" id="noticia_cuerpo" name="noticia_cuerpo"><?php echo $getNoticia[0]['texto']; ?></textarea>
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_fuente">Fuente</label>  
				  <div class="col-md-4">
				  <input id="noticia_fuente" name="noticia_fuente" placeholder="" class="form-control input-md" type="text" value="<?php echo $getNoticia[0]['fuente']; ?>">
				    
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_linkexterno">Link Externo</label>  
				  <div class="col-md-4">
				  <input id="noticia_linkexterno" name="noticia_linkexterno" placeholder="http://www.youtube.com/embed/%REEMPLAZAR-POR-CODIGO%" class="form-control input-md" type="text" value="<?php echo $getNoticia[0]['url_externa']; ?>">
				    
				  </div>
				</div>
                
                <!-- Check input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_fuente">Es Cita *</label>  
				  <div class="col-md-4">
                        <select id="noticia_cita" name="noticia_cita" class="form-control">
							<option value="0" selected="selected">No</option>
							<option value="1">Si</option>
						</select>
				  </div>
				</div>

				<!-- File Button --> 
				<!--
				<div class="form-group">
				  <label class="col-md-4 control-label" for="filebutton">File Button</label>
				  <div class="col-md-4">
				    <input id="filebutton" name="filebutton" class="input-file" type="file">
				  </div>
				</div>
				-->

				<!-- Select Basic -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_categoria">Categoria</label>
				  <div class="col-md-4">
				    <select id="noticia_categoria" name="noticia_categoria" class="form-control">
 					<?php 
				    for($i = 0; $i < count($getCategoria) ; $i++)
                    {
				    ?>	
				    	<option value="<?php echo $getCategoria[$i]['id']; ?>"><?php echo $getCategoria[$i]['nombre'] . ' ('.$getCategoria[$i]['cantidad'].')';?></option>
				    <?php
					}//for
				    ?>
				    </select>
				  </div>
				</div>
				
				<!-- Select Basic -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_tags">Tags</label>
				  <div class="col-md-4">
				    <input type="text" value="<?php echo $getNoticia[0]['tags']; ?>" data-role="tagsinput" name="noticia_tags" name="noticia_tags" class="form-control"/>
				  </div>
				</div>

				<!-- Button -->
				<!--
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_categoria"></label>
				  <div class="col-md-4">
				    Publicar al modificar? <input type="checkbox" value="1" id="noticia_publicar" name="noticia_publicar"/>
				  </div>
				</div>
				-->

				<!-- Button -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_agregar"></label>
				  <div class="col-md-4">
				    <button id="submit" name="submit" class="btn btn-primary">Modificar</button>
				  </div>
				</div>

			</fieldset>
		</form>





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
