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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 col-md-6">
        <div class="card-body">
            <h4 class="card-title text-center text-primary mb-4">Registrar Usuario</h4>
            <form method="POST" action="">
                <?php
                include('conexion.php');
                $idpaciente = $_GET['idpaciente'];
                $cpaciente = mysqli_query($conexion, "SELECT * FROM paciente WHERE idpaciente='$idpaciente'");
                $datos = mysqli_fetch_array($cpaciente);

                $nombrecompleto = $datos['nombre'];
                $apellido = $datos['apellido'];
                $partes = explode(" ", $nombrecompleto . " " . $apellido);

                $codusuario = strtolower(substr($partes[0], 0, 1) . $partes[1]);
                if (count($partes) >= 3) {
                    $codusuario .= substr($partes[2], 0, 1);
                }

                echo "<p><strong>Nombre Completo:</strong> $nombrecompleto $apellido</p>";
                echo "<p><strong>Código de Usuario:</strong> $codusuario</p>";
                ?>

                <div class="mb-3">
                    <label for="txtclave1" class="form-label">Clave:</label>
                    <input type="password" class="form-control" id="txtclave1" name="txtclave1" placeholder="Ingrese la clave" required>
                </div>

                <div class="mb-3">
                    <label for="txtclave2" class="form-label">Repita Clave:</label>
                    <input type="password" class="form-control" id="txtclave2" name="txtclave2" placeholder="Confirme la clave" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Usuario:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipousuario" value="PAC" id="tipoPac" checked>
                        <label class="form-check-label" for="tipoPac">PAC</label>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" name="btnregistrar">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['btnregistrar'])) {
        include('conexion.php');
        $clave1 = $_POST['txtclave1'];
        $clave2 = $_POST['txtclave2'];
        $tipousuario = $_POST['tipousuario'];

        if ($clave1 == $clave2) {
            $clave = $clave1; // md5() opcional
            mysqli_query($conexion, "INSERT INTO usuario (usuario, pass, tipo, idpaciente) VALUES ('$codusuario', '$clave', '$tipousuario', '$idpaciente')");
            mysqli_query($conexion, "UPDATE $tabla_db1 SET idpaciente='$idpaciente', estado='d' WHERE idpaciente='$idpaciente'");
            echo "
            <script>
                alert('Usuario almacenado exitosamente');
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Las claves no coinciden');
            </script>
            ";
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
