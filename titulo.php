<?php
session_start();
ob_start();	
include("conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
	<title></title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  		<div class="container-fluid">
    		<a class="navbar-brand" href="#">Centro de Salud</a>
    	<div class="collapse navbar-collapse" id="navbarColor01">
    		 <!--<div class="dropdown-divider"></div>-->
    		 <a class="dropdown-item" href="#"></a><!--separador de espacio-->
    		<?php
				if (!isset($_SESSION['usuario']))
					{
						echo "no se a iniciado sesion";
					}	
				else
				{
					
					echo "<label class='navbar-brand' href='#'>Usuario: ".$_SESSION['usuario']." </label>  ";
				};
			?>
        		<a href="logout.php" target="_top"><button class="btn btn-danger my-2 my-sm-0" type="submit">Salir</button></a>
    	</div>
  		</div>
</nav>
</body>
</html>