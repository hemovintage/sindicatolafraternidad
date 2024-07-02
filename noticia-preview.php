<?php
require_once('auth.php');//valida session
require_once('include/functions.php');
require_once('include/constants.php');
?>
  	<?php 
    
	if(empty($_REQUEST['id']))
	{
        $redirect = FULL_PATH . 'noticia-listar.php';
		header("Location: $redirect");
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
    $getImagenes =  $objetoNoticia->getImagenByNoticiaId($noticiaId);
    
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
				  <label class="col-md-4 control-label" for="noticia_fuente">Es Cita * </label>  
				  <div class="col-md-4">
                        <select id="noticia_cita" name="noticia_cita" class="form-control">
							<option value="0" <?php if(empty($getNoticia[0]['cita'])){ echo 'selected="selected"';} ?>>No</option>
							<option value="1" <?php if(!empty($getNoticia[0]['cita'])){ echo 'selected="selected"';} ?>>Si</option>
						</select> 
				  </div>
                  
				</div>
                
                <!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_linkexterno">Imagen</label>  
				  <div class="col-md-4">

					<span class="block-input-clon"> 
						<input id="noticia_filebutton_0" name="noticia_filebutton_0" class="input-file" type="file" />
						<input type="text" id="noticia_filebuttontext_0" name="noticia_filebuttontext_0" class="form-control input-md" placeholder="Epigrafe..." style="margin-bottom: 10px; margin-top: 5px"/>
						
					</span>
					
					<a href="javascript:void(0)" onclick="addInput()">Agregar otra imagen</a>
					<!--
				     <span class="help-block">herramienta de resizeo de imagenes: <a href="http://www.resizeyourimage.com" target="_blank">www.resizeyourimage.com</a> </span>
					 -->
				    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                    <hr />

				  <!--<input id="noticia_linkexterno" name="noticia_linkexterno" placeholder="http://www.youtube.com/embed/%REEMPLAZAR-POR-CODIGO%" class="form-control input-md" type="text" value="<?php echo $getNoticia[0]['url_externa']; ?>">-->
                    <ul class="image-list list-group row">
                    <?php 
                    if(!empty($getImagenes)){
                        foreach($getImagenes as $imagen){
                            $imagePath = $imagen['relative_path'];
                            $idArchivo = $imagen['id'];
                    ?>
                    <li class="list-group-item col-xs-6">
                        <img src="<?php echo FULL_PATH_SITE_IMAGES_UPLOAD . $imagePath;?>" alt="imagen" width="100%"/>    
                        <span class="glyphicon glyphicon-remove-circle" id="<?php echo $idArchivo; ?>" ></span>
                    </li>
                    <?php
                        }//foreach
                    }else{
                    ?>
                    <li>
                        <img src="<?php echo FULL_PATH_SITE_IMAGES_UPLOAD ;?>logo90x90.jpg" alt="imagen" />    
                    </li>
                    <?php
                    }//if
                    ?>
                    </ul>
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

				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_actualizar_fecha">Actualizar Fecha?</label>
				  <div class="col-md-4">
				    <select id="noticia_actualizar_fecha" name="noticia_actualizar_fecha" class="form-control">
				    	<option value="1">SI</option>
						<option value="0" selected="selected">NO</option>
				    </select>
				  </div>
				
				</div>
				<input type="hidden" value="1" id="noticia_preview" name="noticia_preview" />
				<!-- Button -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_agregar"></label>
				  
				  <div class="col-md-4">
				    <button class="btn btn-primary" onclick="javascript:$('#noticia_preview').val('1');">Previsualizar</button>
				    <button id="submit" name="submit" class="btn btn-primary" onclick="javascript:$('#noticia_preview').val('0');">Modificar/Guardar</button>
				  </div>
				</div>

			</fieldset>
		</form>


<style>
.image-list{
    list-style-type: none;
}
.image-list li{
    width:150px;    
}
.image-list li span{
    position:absolute;
    cursor: pointer;
}    
</style>

<link type="text/css" rel="stylesheet" href="css/jquery-te-1.4.0.css">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script type="text/javascript" src="js/bootstrap-tagsinput.js" charset="utf-8"></script>

<!--<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>-->


<script>
$('.jqte-test').jqte();

$( document ).ready(function()
{
	$(".jqte_tool_1").hide();
	$(".jqte_tool_2").hide();	
	$(".jqte_tool_3").hide();	
	$(".jqte_tool_7").hide();
	$(".jqte_tool_8").hide();	
	$(".jqte_tool_9").hide();	
	$(".jqte_tool_10").hide();
	$(".jqte_tool_11").hide();	
	$(".jqte_tool_12").hide();	
	$(".jqte_tool_13").hide();
	$(".jqte_tool_14").hide();	
	$(".jqte_tool_15").hide();	
	$(".jqte_tool_16").hide();
	//$(".jqte_tool_17").hide();//	url
	$(".jqte_tool_18").hide();	
	$(".jqte_tool_19").hide();
	$(".jqte_tool_20").hide();	
	$(".jqte_tool_21").hide();	
	$(".jqte").css('margin',0);
});

function addInput(){

	// DUPLICO ELEMENTOS 
	
	//clono el elemento input FILE
	$(".block-input-clon input[type=file]:last").clone().appendTo(".block-input-clon" );
	//clono el elemento input TEXT
	$(".block-input-clon input[type=text]:last").clone().appendTo(".block-input-clon" );
	
	
	//RENOMBRO IDS de ELEMENTOS
	
	//tomo el ultimo elemento input 
	var newInputFile = $('.block-input-clon input[type=file]:last').attr('id');
	var newInputText = $('.block-input-clon input[type=text]:last').attr('id');

	//split text 
	var lastId = newInputFile.split("_");
	var lastId = lastId[2];
	var lastId = parseInt(lastId) + 1;
	
	//Se hace efectivo el renombramiento de archivos
	//Cambio atributos de Input file
	$('.block-input-clon input[type=file]:last').attr('id', 'noticia_filebutton_'+lastId);
	$('.block-input-clon input[type=file]:last').attr('name', 'noticia_filebutton_'+lastId);
	
	//Cambio atributos de Input Text
	$('.block-input-clon input[type=text]:last').attr('id', 'noticia_filebuttontext_'+lastId);
	$('.block-input-clon input[type=text]:last').attr('name', 'noticia_filebuttontext_'+lastId);
	
}//function addinput

$(".image-list li span").click(function() {
    if(confirm("Esta seguro que desea borrar esta imagen?")){
        var idImagen = $(this).attr('id');
                    
        $.ajax({
            type: "POST",
            url: "ajax/noticia-imagen.php",
            data: {idNoticiaImagen: idImagen},
            dataType: "json",
            success: function (data) {
                
                if (data.result == 1) {
                    //$(this).parent().remove(); 
                    //console.log('se supone que esto borra la imagen');
                } else {
                    alert('Hubo un error al borrar la imagen');
                }
            }//success

        }); // Semi-colons after all declarations, IE is picky on these things.
        
        $(this).parent().remove(); //borro elemento html de la imagen
    }
    else
    {
        //console.log('no');
    }
});


/*
// settings of status
var jqteStatus = true;
$(".status").click(function()
{
    jqteStatus = jqteStatus ? false : true;
    $('.jqte-test').jqte({"status" : jqteStatus})
});
*/
</script>
<style>
.bootstrap-tagsinput {
    width: 100%;
}

.bootstrap-tagsinput input{
    width: 100%;
}

</style>
  </body>
</html>
