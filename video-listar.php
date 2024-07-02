<?php
require_once('auth.php');//valida session
?>
  	<?php require_once('header.php'); ?>
  	<?php 

  	/* NOTICIAS */
	require_once('include/Video.php');

	$cantidadDeVideos = 20;

	$objetoVideo = new Video();

	$getVideos = $objetoVideo->getLatestVideos($cantidadDeVideos);

	/* Functions */

	function limitString($string, $limit = 100) {
	    // Return early if the string is already shorter than the limit
	    if(strlen($string) < $limit) {return $string;}

	    $regex = "/(.{1,$limit})\b/";
	    preg_match($regex, $string, $matches);
	    return $matches[1] . '...';
	}


  	?>
  	<form class="form-horizontal" style="text-align:center;">
		<fieldset>
		<legend>Videos</legend>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered">
						<thead>
						  <tr>
						    <th class="col-md-2">Titulo</th>
							<th class="col-md-2">Thumb</th>
						    <th class="col-md-1">Fuente</th>
						    <th class="col-md-1">Id de Video</th>
						    <th class="col-md-1">Categoria</th>
							<th class="col-md-1">Visible</th>
						    <th class="col-md-1">Acción</th>
						  </tr>
						</thead>
						<tbody>
							<?php 

							for($i = 0; $i < count($getVideos) ; $i++)
                            {
                            	$id = $getVideos[$i]['id'];
                                $titular = limitString($getVideos[$i]['titulo'],88);
								$fuente = $getVideos[$i]['source'];
								$videoId = $getVideos[$i]['video_id'];
								$categoria = $getVideos[$i]['categoria'];
								if($getVideos[$i]['visible'] == 'Y')
								{
									$visible = "Si";
								}
								else
								{
									$visible = "No";
								}
								
								$thumb = $objetoVideo->getThumb($videoId,$fuente);
								

								
								$visibilidad = $getVideos[$i]['visible'];
								if($visibilidad == "N")
								{
									$visibilidad = "No";
									$estadoBoton = "Publicar";
									$cambiaEstado = "&visible=Y";
								}
								else
								{
									$visibilidad = "Si";
									$estadoBoton = "Ocultar";
									$cambiaEstado = "&visible=N";
								}
								
								//$linkEdit = 'noticia-edit.php?id=' . $noticiaId;
								$linkEdit = 'video-edit.php?id=' . $id;
								$linkBorrar = 'ajax/video-estado.php?id=' . $id . $cambiaEstado;
								$linkErase = 'ajax/video-estado-erase.php?id=' . $id;
								
                            ?>
							<tr>
								<td><?php echo $titular; ?></td>
								<td><img src='<?php echo $thumb; ?>' alt='<?php echo $titular; ?>' width='200' /></td>
								<td><?php echo $fuente; ?></td>
								<td><?php echo $videoId; ?></td>
								
								<td><?php echo $categoria; ?></td>
								<td><?php echo $visible; ?></td>
								<td>
									<a target="_self" href='<?php echo $linkEdit; ?>' class="btn btn-block btn-info">Editar</a>
									<a target="_self" href='<?php echo $linkBorrar; ?>' class="btn btn-block btn-info"><?php echo $estadoBoton; ?></a>
									<a target="_self" href='<?php echo $linkErase; ?>' class="btn btn-block btn-info">Eliminar</a>
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