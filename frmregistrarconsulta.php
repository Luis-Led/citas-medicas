<?php 
	session_start();
	ob_start();
	include("conexion.php");
	if ($_SESSION['sesion_exito']<>1) 
	{
  		header('Location:index.php');
	};
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Consulta</title>

    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 30px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 30px;
        }

        .form-group label {
            font-weight: 600;
        }

        .btn-success {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            font-size: 1.1rem;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .text-center {
            margin-top: 20px;
        }

        .container {
            max-width: 800px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <center>
                        <h1>Registrar Consulta</h1>
                    </center>
                    <form method="POST" action="frmregistrarconsulta.php">
                        <div class="form-group">
                            <?php
                            $datos = null;
                            if (isset($_GET['idpaciente'])) {
                                $idpaciente = $_GET['idpaciente'];
                                // Recuperamos los datos del paciente de la base de datos
                                $cpaciente = mysqli_query($conexion, "SELECT * FROM paciente WHERE idpaciente='$idpaciente'");
                                $datos = mysqli_fetch_array($cpaciente);
                            }
                            if ($datos) {
                                // Mostramos el nombre completo del paciente
                                echo "<strong><Label>Nombre Paciente:  </Label></strong>";
                                $nombrecompleto = $datos['nombre'];
                                $apellido = $datos['apellido'];
                                echo "<br><div>$nombrecompleto $apellido</div>";
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="sintomas">Síntomas</label>
                            <input type="text" class="form-control" id="sintomas" name="sintomas" required>
                        </div>

                        <div class="form-group">
                            <label for="diagnostico">Diagnóstico</label>
                            <input type="text" class="form-control" id="diagnostico" name="diagnostico" required>
                        </div>

                        <div class="form-group">
                            <label for="receta">Receta</label>
                            <input type="text" class="form-control" id="receta" name="receta" required>
                        </div>

                        <div class="text-center">
                            <input type="submit" value="Registrar" class="btn btn-primary" name="btn1">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        $cpaciente = mysqli_query($conexion, "SELECT cita.idcita, medico.idmedico, medico.nombre AS nombremedico, cita.idpaciente, paciente.nombre, paciente.apellido, cita.fechacita, cita.hora, cita.estado FROM cita, paciente, medico WHERE paciente.idpaciente=cita.idpaciente and medico.idmedico=cita.idmedico and cita.estado='p'");
        $datos = mysqli_fetch_array($cpaciente);
        $idpac = $datos['3'];

        if (isset($_POST['btn1'])) {
            include('conexion.php');
            //obtenemos el idmedico mediante variable global
            $idmed = $_SESSION['idmedico'];
            //obtenemos el id paciente mediante el metodo get
            $sintomas = $_POST['sintomas'];
            $diagnosotico = $_POST['diagnostico'];
            $receta = $_POST['receta'];
            $cons = mysqli_query($conexion, "INSERT INTO consulta(idpaciente,idmedico,sintomas,diagnostico,receta)VALUES($idpac,$idmed,'$sintomas','$diagnosotico','$receta')");
            $act = mysqli_query($conexion, "UPDATE cita SET estado='c' WHERE idpaciente='$idpac' and idmedico='$idmed'");
            //actualiza estado de inactivo a activo
            if ($cons && $act) {
                echo "
                    <script>
                        alert('Se Registró Exitosamente');
                    </script>
                ";
                include("cerrar.php");
            }
        }
        ?>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
