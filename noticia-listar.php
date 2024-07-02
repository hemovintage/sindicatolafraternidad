<?php
require_once('auth.php');//valida session

require_once('header.php'); 

/* NOTICIAS */
require_once('include/Noticia.php');
require_once('include/functions.php');

$cantidadDeNoticias = 100;

$objetoNoticia = new Noticia();

$getNoticias = $objetoNoticia->getLatestNoticias($cantidadDeNoticias);

/* Functions */

function limitString($string, $limit = 100) {
    // Return early if the string is already shorter than the limit
    if(strlen($string) < $limit) {return $string;}

    $regex = "/(.{1,$limit})\b/";
    preg_match($regex, $string, $matches);
    return $matches[1] . '...';
}

//echo ld($getNoticias,'news');
/*
IMAGENES : 
a las notas agregar un getImagesByNotaId 
y que el query SOLO traiga las imagenes NO BORRADAS 
*/
  	?>
  	<form class="form-horizontal" style="text-align:center;">
		<fieldset>
		<legend>Noticias</legend>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered">
						<thead>
						  <tr>
						    <th class="col-md-2">Titulo</th>
						    <th class="col-md-4">Resumen</th>
						    <th class="col-md-1">Fecha</th>
						    <th class="col-md-1">Thumb</th>
						    
						    <th class="col-md-1">Visible</th>
							
						    <th class="col-md-1">Acción</th>
						  </tr>
						</thead>
						<tbody>
							<?php 

							for($i = 0; $i < count($getNoticias) ; $i++)
              {
              	$noticiaId = $getNoticias[$i]['id'];
                $titular = limitString($getNoticias[$i]['titulo'],88);
                $resumen = limitString($getNoticias[$i]['resumen'],100);

                $objetoImagen = $objetoNoticia->getImagenByNoticiaId($noticiaId);

                $imagen = FULL_PATH_SITE_IMAGES . "logo90x90.jpg";

                if(!empty($objetoImagen)){

//				          if( (empty($getNoticias[$i]['path'])) || ($getNoticias[$i]['imagen_deleted'] == 1) )
				          if( (empty($objetoImagen[0]['relative_path'])) || ($objetoImagen[0]['isDeleted'] == 1) )
				          {
                    //$imagen = "http://sindicatolafraternidad.org/images/logo90x90.jpg";
                    $imagen = FULL_PATH_SITE_IMAGES . "logo90x90.jpg";
				          }
				          else
				          {
					          //$imagen = $getNoticias[$i]['path'];
                    $imagen = FULL_PATH_SITE_IMAGES_UPLOAD . $objetoImagen[0]['relative_path'];
				          }
                }//if objetoImagen

								$fecha = $getNoticias[$i]['fecha'];
								$visibilidad = $getNoticias[$i]['visible'];
								if($visibilidad == 0)
								{
									$visibilidad = "No";
									$estadoBoton = "Publicar";
									$cambiaEstado = "&visible=1";
									$visibilidadColor = "#D4A190";
								}
								else
								{
									$visibilidad = "Si";
									$estadoBoton = "Ocultar";
									$cambiaEstado = "&visible=0";
									$visibilidadColor = "#A1D490";
								}
								//$linkEdit = 'noticia-edit.php?id=' . $noticiaId;
								$linkEdit = 'noticia-preview.php?id=' . $noticiaId;
								$linkBorrar = 'ajax/noticia-estado.php?id=' . $noticiaId . $cambiaEstado;
								$linkErase = 'ajax/noticia-estado-erase.php?id=' . $noticiaId;
                                $youtube = $getNoticias[$i]['url_externa'];
                            ?>
							<tr>
								<td><?php echo $titular; ?></td>
								<td><?php echo $resumen; ?></td>
								<td><?php echo $fecha; ?></td>
								<td>
                                    <?php 
                                    if($youtube){
                                    ?>
                                    <img src="images/youtube.png" alt="" height="" width="" />
                                    <hr />
                                    <?php
                                    }//if youtube
                                    ?>
                                    <img src='<?php echo $imagen; ?>' alt='<?php echo $titular; ?>' width='72' />
                                </td>
								<td style="background-color:<?php echo $visibilidadColor; ?>"><?php echo $visibilidad; ?></td>
								<td>
									<a target="_self" href='<?php echo $linkEdit; ?>' class="btn btn-block btn-info">Editar</a>
									<a target="_self" href='<?php echo $linkBorrar; ?>' class="btn btn-block btn-info"><?php echo $estadoBoton; ?></a>
									<a target="_self" href='<?php echo $linkErase; ?>' onclick="return confirm('Esta seguro que desea borrar esta Noticia?')" class="btn btn-block btn-info">Eliminar</a>
								</td>
							</tr>
							<?php
							}//for
							?>	
						</tbody>
					</table>
				</div>
			</div>
		</fieldset>
	</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
