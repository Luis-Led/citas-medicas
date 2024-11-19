<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilos.css">

    <!-- SWeetalert -->
    <script src="SweetAlert/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="SweetAlert/sweetalert2.css">
</head>
<body>
<?php
    session_start();
    ob_start();
    if (isset($_SESSION['sesion_exito'])) {
        
        if ($_SESSION['sesion_exito']==0) {
            
            echo"
                <script>
					Swal.fire(
					'Inicie Sesion Por Favor!',
					'You clicked the button!',
					'info'
					)
				</script>";
        }

        if ($_SESSION['sesion_exito']==2) {
            
            echo"
            <script>
					Swal.fire(
					'Los campos son obligatorios!',
					'You clicked the button!',
					'warning'
					)
				</script>";
        }

        if ($_SESSION['sesion_exito']==3) {
            
            echo"
            <script>
					Swal.fire(
					'Datos Incorrectos !',
					'You clicked the button!',
					'error'
					)
				</script>";
        }
    }
    else {
        $_SESSION['sesion_exito']=0;
    }
?>
    <div class="content">
        <form class="formulario" action="acceso.php" method="POST">
            <div class="titulo">
                <img src="img/Doctor.png" alt="" class="doc">
                <h1>Inicio de sesion</h1>
            </div>
            <div class="inputs">
                <input type="text" name="user" class="item" placeholder="Nombre Usuario">
                <input type="password" name="pass" class="item" placeholder="Contraseña">
            </div>
            <div class="iniciar">
                <button name="btn_index"> Iniciar Sesion </button>
            </div>
        </form>
    </div>
</body>
</html>