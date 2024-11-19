<?php 
	session_start();
	ob_start();
	include('conexion.php');
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
    <title>Registrar Cita Médica</title>

    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">

    <!-- SweetAlert2 -->
    <script src="SweetAlert/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="SweetAlert/sweetalert2.css">

    <!-- jQuery -->
    <script src="Jquery/jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#cboespecialidad').change(function() {
                var esp = $('#cboespecialidad').val();
                $.ajax({
                    type: 'POST',
                    url: 'obtener_medico.php',
                    data: {
                        especialidad: esp
                    },
                    success: function(ev) {
                        $('#cbomedico').html(ev);
                    }
                });
            });
        });
    </script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 700px;
            margin-top: 50px;
        }

        .card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .form-label {
            font-weight: bold;
        }

        .btn {
            width: 100%;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <h3 class="text-center text-primary mb-4">Registrar Cita Médica</h3>
            <form method="POST" action="">
                <?php  
                    include "conexion.php";
                    $idpaciente = $_SESSION['idpaciente']; // Variable de sesión para el paciente
                    $cons = mysqli_query($conexion, "SELECT * FROM $tabla_db1 WHERE idpaciente='$idpaciente'"); // Consulta para obtener datos del paciente
                    while ($paciente = mysqli_fetch_array($cons)) {
                        $ci = $paciente['ci'];
                        $nombre = $paciente['nombre'];
                        $apellido = $paciente['apellido'];
                    }
                ?>

                <!-- Datos del paciente -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Paciente:</label>
                    <p id="nombre" class="form-control-plaintext"><?php echo $nombre; ?></p>
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <p id="apellido" class="form-control-plaintext"><?php echo $apellido; ?></p>
                </div>

                <div class="mb-3">
                    <label for="ci" class="form-label">CI:</label>
                    <p id="ci" class="form-control-plaintext"><?php echo $ci; ?></p>
                </div>

                <!-- Especialidad y Médico -->
                <div class="mb-3">
                    <label for="cboespecialidad" class="form-label">Especialidad:</label>
                    <select class="form-select" name="cboespecialidad" id="cboespecialidad">
                        <option selected>Seleccione Especialidad</option>
                        <?php 
                            $especialidad = mysqli_query($conexion, "SELECT * FROM especialidad");
                            while ($esp = mysqli_fetch_array($especialidad)) {
                                echo "<option value='$esp[0]'>$esp[1]</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cbomedico" class="form-label">Médico:</label>
                    <select class="form-select" name="cbomedico" id="cbomedico">
                        <option selected>Seleccione Médico</option>
                    </select>
                </div>

                <!-- Fecha y Hora -->
                <div class="mb-3">
                    <label for="fechacita" class="form-label">Fecha de la Cita:</label>
                    <input type="date" class="form-control" id="fechacita" name="fechacita">
                </div>

                <div class="mb-3">
                    <label for="horacita" class="form-label">Hora de la Cita:</label>
                    <input type="time" class="form-control" id="horacita" name="horacita">
                </div>

                <!-- Botón de Registrar -->
                <button type="submit" class="btn btn-primary" name="btn1">Registrar Cita</button>
            </form>
        </div>
    </div>

    <?php 
        if (isset($_POST['btn1'])) {
            $idpaciente = $_SESSION['idpaciente']; // Paciente logueado
            $medico = $_POST['cbomedico']; // Médico seleccionado
            $fechacita = $_POST['fechacita']; // Fecha seleccionada
            $horacita = $_POST['horacita']; // Hora seleccionada

            // Insertar la cita en la base de datos
            $citareg = mysqli_query($conexion, "INSERT INTO cita(idpaciente, idmedico, fechacita, hora) VALUES ($idpaciente, $medico, '$fechacita', '$horacita')");
            if ($citareg) {
                echo "
                    <script>
                        Swal.fire({
                            title: 'Éxito',
                            text: '¡Registro Exitoso!',
                            icon: 'success'
                        });
                    </script>
                ";
            } else {
                echo "
                    <script>
                        Swal.fire({
                            title: 'Oops',
                            text: 'Algo salió mal.',
                            icon: 'error'
                        });
                    </script>
                ";
            }
        }
    ?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
