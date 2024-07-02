<?php
session_name("loginUsuario"); 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sindicato La Fraternidad</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
 	<div style="height:80px; background-color:#ccc;text-align:center; border-bottom:3px solid #000;  ">
  		<img src="http://www.sindicatolafraternidad.org/images/logo.png" height="75" align="middle" style="padding-bottom:5px;" />
  	</div>

    <nav class="navbar navbar-default" role="navigation">
   <div class="navbar-header">
      <a class="navbar-brand" href="#">Sindicato La Fraternidad</a>
   </div>

</nav>
	<form action="login.php" method="post" class="form-horizontal" style="text-align:center;">
		<fieldset>

		<!-- Form Name -->
		<!--
		<legend>Form Name</legend>
		-->
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="username">Usuario</label>
		  <div class="controls">
		    <input id="username" name="username" placeholder="" class="input-xlarge" required="" type="text">
		    <!--<p class="help-block">Ingrese su usuario</p>-->
		  </div>
		</div>

		<!-- Password input-->
		<div class="control-group">
		  <label class="control-label" for="password">Contraseña</label>
		  <div class="controls">
		    <input id="password" name="password" placeholder="" class="input-xlarge" required="" type="password">
		    
		  </div>
		</div>

		<!-- Button -->
		<div class="control-group">
		  <label class="control-label" for="submit"></label>
		  <div class="controls">
		    <button id="submit" name="submit" class="btn btn-primary" >Ingresar</button>
		    <?php
		    if(isset($_GET['errno']) && $_GET['errno'] == 1)
		    {
	    	?>
	    	<p class="help-block">ERROR AL AUTENTICAR USUARIO</p>
	    	<?php
		    }
		    ?>
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