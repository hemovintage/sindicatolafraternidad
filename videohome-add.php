<?php
require_once('auth.php');//valida session
?>
<?php 
require_once('header.php'); 

require_once('include/Video.php');
//instancio
$video = new Video();

$id = 1; //recibe un id por post...

//setea noticia 
$home = $video->getVideoHome($id);

?>

	<form enctype="multipart/form-data" class="form-horizontal" style="text-align:left;" action="videohome-post.php" method="POST" >
		<fieldset>

			<!-- Form Name -->
			<legend>Agregar Video de Home</legend>
				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="video_titulo">Titulo</label>  
				  <div class="col-md-4">
				  <input id="video_titulo" name="video_titulo" placeholder="" class="form-control input-md" required="" type="text" value="<?php echo $home[0]['description']; ?>">
				    
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="video_id">Id de Video</label>  
				  <div class="col-md-4">
					<input id="video_id" name="video_id" placeholder="" class="form-control input-md" type="text" value="<?php echo $home[0]['video_id']; ?>">
					<u><strong>id en Vimeo:</strong></u> http://vimeo.com/<u><strong style="color:red">10533079</strong></u>
					<br />
					<u><strong>id en Youtube:</strong></u> https://www.youtube.com/watch?v=<u><strong style="color:red;">imf25Squ8ro</strong></u>
				  </div>
				</div>


				<!-- Select Basic -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="video_source">Source</label>
				  <div class="col-md-4">
				    <select id="video_source" name="video_source" class="form-control">
				    	<option value="youtube" <?php if($home[0]['source'] == 'youtube'){ echo "selected='selected'";} ?> >Youtube</option>
						<option value="vimeo" <?php if($home[0]['source'] == 'vimeo'){ echo "selected='selected'";} ?>>Vimeo</option>
				    </select>
				  </div>
				</div>

				<!-- Button -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="video_agregar"></label>
				  <div class="col-md-4">
				    <button id="submit" name="submit" class="btn btn-primary" >Guardar</button>					
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
	
	<!--<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>-->
	

  </body>
</html>