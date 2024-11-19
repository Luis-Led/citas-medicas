<?php 
   session_start();
   ob_start();
   include('conexion.php');
   if ($_SESSION['sesion_exito']!=1) 
   {
      header('Location:index.php');
   };
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
   <title></title>
</head>
<body class="bg-primary"> 
   <form>
      <legend class="text-light text-center">MENU</legend>
      <nav>
         <div class="d-grid gap-2">
            <?php
               if (!isset($_SESSION['usuario']))
                  {
                     echo "no se a iniciado sesion";
                  }
               else
               {
                  echo "<center><label class='text-light'>".$_SESSION['usuario']."";
                  echo "-".$_SESSION['tipo']."</label></center><hr>";
                  $tipo=$_SESSION['tipo'];
                  $opciones=mysqli_query($conexion,"SELECT * FROM menu m, `usuario-menu` u WHERE m.idmenu=u.opcion AND u.tipo='$tipo'");
                  while ($fopc=mysqli_fetch_array($opciones)) 
                  {     
                     echo "<a href='".$fopc[2]."'class='btn btn-primary btn-block' target='cuerpo' type='button'>".$fopc[1]."</a>";
                     # code...

                  }
                  mysqli_close($conexion);
               };

            ?>
         </div>
      </nav>
</body>
</html>