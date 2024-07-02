<?php
require_once('auth.php');//valida session
?>
<?php 
require_once('header.php'); 

/* CATEGORIAS */

require_once('include/Categoria.php');

$objetoCategoria = new Categoria();

$getCategoria = $objetoCategoria->getAllCategoriasAvailables();

?>

	<form enctype="multipart/form-data" class="form-horizontal" style="text-align:left;" action="noticia-post.php" method="POST" >
		<fieldset>

			<!-- Form Name -->
			<legend>Agregar Noticia</legend>
				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_titulo">Titulo</label>  
				  <div class="col-md-4">
				  <input id="noticia_titulo" name="noticia_titulo" placeholder="Evite el uso de MAYÚSCULAS en todo el título" class="form-control input-md" required="" type="text">
				    
				  </div>
				</div>

				<!-- Textarea -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_resumen">Resumen</label>
				  <div class="col-md-4">                     
				    <textarea class="form-control" id="noticia_resumen" name="noticia_resumen" placeholder="Siempre que Pegue texto en cualquiera de los campos, deberá antes Copiarlo en el Bloc de Notas. Esto evitará un cambio de estilos"></textarea>
				  </div>
				</div>

				<!-- Textarea -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_cuerpo">Texto</label>
				  <div class="col-md-4">                     
				    <textarea class="jqte-test form-control" id="noticia_cuerpo" name="noticia_cuerpo"></textarea>
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_fuente">Fuente</label>  
				  <div class="col-md-4">
				  <input id="noticia_fuente" name="noticia_fuente" placeholder="Cite aquí la fuente de información cuando sea necesario" class="form-control input-md" type="text">
				    
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_linkexterno">Link Externo</label>  
				  <div class="col-md-4">
					<input id="noticia_linkexterno" name="noticia_linkexterno" placeholder="Ingrese únicamente el código de Video" class="form-control input-md" type="text">
					<input type="checkbox" value='1' id="noticia_video_assign" name="noticia_video_assign"/> Asignar video a Galeria Multimedia<br>
					<!--
					<u><strong>id en Vimeo:</strong></u> http://vimeo.com/<u><strong style="color:red">10533079</strong></u>
					<br />
					-->
					<u><strong>id en Youtube:</strong></u> https://www.youtube.com/watch?v=<u><strong style="color:red;">imf25Squ8ro</strong></u> 
					
					<br />
					
					
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

				<div class="form-group">
				  <label class="col-md-4 control-label" for="filebutton">Imagen</label>
				  <div class="col-md-4">
					<span class="block-input-clon"> 
						<input id="noticia_filebutton_0" name="noticia_filebutton_0" class="input-file" type="file" />
						<input type="text" id="noticia_filebuttontext_0" name="noticia_filebuttontext_0" class="form-control input-md" placeholder="Aquí puede agregar una breve descripción en cada foto..." style="margin-bottom: 10px; margin-top: 5px"/>
						
					</span>
					
					<a href="javascript:void(0)" onclick="addInput()">Agregar otra imagen</a>
					<!--
				     <span class="help-block">herramienta de resizeo de imagenes: <a href="http://www.resizeyourimage.com" target="_blank">www.resizeyourimage.com</a> </span>
					 -->
				    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				  </div>
				</div>

				<!-- File Button Large --> 
				<!--
				<div class="form-group">
				  <label class="col-md-4 control-label" for="filebutton-large">Imagen Large (614xProp)</label>
				  <div class="col-md-4">
				    <input id="noticia_filebutton" name="noticia_filebutton" class="input-file" type="file" />
				    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
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
				    <input type="text" value="" data-role="tagsinput" name="noticia_tags" name="noticia_tags" placeholder="Utilice palabras claves separadas por comas Ej:circular, paro gremial, omar maturano" "class="form-control"/>
				  </div>
				</div>


				<div class="form-group">
					<label class="col-md-4 control-label" for="noticia_preview">Previsualizar</label>
					  <div class="col-md-4">
						<select id="noticia_preview" name="noticia_preview" class="form-control">
							<option value="0" selected="selected">No</option>
							<option value="1">Si</option>
						</select>
					  </div>					
				</div>
				<!-- Button -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="noticia_agregar"></label>
				  <div class="col-md-4">
				    <!--<button id="noticia_agregar" name="noticia_agregar" class="btn btn-primary" onclick="return false;">Agregar</button>-->
					<!--<button id="submit" name="submit" class="btn btn-primary" >Previsualizar</button>-->
				    <button id="submit" name="submit" class="btn btn-primary" >Agregar</button>					
				  </div>
				</div>

			</fieldset>
		</form>





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

//duplica inputs
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
	//$(".jqte_tool_17").hide();	//url
	$(".jqte_tool_18").hide();	
	$(".jqte_tool_19").hide();
	$(".jqte_tool_20").hide();	
	$(".jqte_tool_21").hide();	
	$(".jqte").css('margin',0);
});

/*
	var data = new FormData();
	jQuery.each($('#noticia_filebutton')[0].files, function(i, file) {
	    data.append('file-'+i, file);
	});
*/

/*
	$.ajax({
    url: 'php/upload.php',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function(data){
        alert(data);
    }
});
*/


/*
	function getFiles()
	{
		var file = $('#noticia_filebutton')[0].files[0]
		if(file){
		  console.log(file);
		}
	}
*/

/*
	$(function() {

	    $("button#noticia_agregar").click(function(){

            $.ajax({
	            	
	            	type: "POST",
	        		enctype: 'multipart/form-data',
	        		url: "/admin/noticia-post.php",
	        		data: $('form.form-horizontal').serialize(),
	        		cache: false,
				    contentType: false,
				    processData: false,        		
            		success: function(msg){
	            		if(msg == '0')
	            		{
	            			alert('Hubo un error al insertar noticia');
	            		}
	            		else
	            		{
	            			alert('Noticia insertada con exito!');
	            			window.location = "noticia-listar.php";
	            		}
	                	//$("#thanks").html(msg)
	                	//$("#form-content").modal('hide');    
	                }

			});//ajax
	    });//click
	});//function
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
