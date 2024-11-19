<?php 
	session_start();
	ob_start();
	include('conexion.php');
	if ($_SESSION['sesion_exito'] != 1) {
		header('Location:index.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Médicas Programadas</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            padding-top: 30px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #007bff;
        }

        .table-container {
            margin-top: 50px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .btn {
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .container {
            max-width: 1200px;
        }
    </style>
</head>

<body>

    <div class="container">
        <center>
            <h1>Citas Médicas Programadas</h1>
        </center>

        <?php 
        include('conexion.php');
        $idmed = $_SESSION['idmedico']; // ID del médico logueado

        $resultados = mysqli_query($conexion, "SELECT cita.idcita, medico.idmedico, medico.nombre AS nombremedico, cita.idpaciente, paciente.nombre, paciente.apellido, cita.fechacita, cita.hora, cita.estado FROM cita, paciente, medico WHERE paciente.idpaciente=cita.idpaciente and medico.idmedico=cita.idmedico and cita.estado='p' and cita.idmedico=$idmed");

        echo "<div class='table-container'>
                <div class='card'>
                    <table id='tablalista' class='table table-striped table-hover table-bordered'>
                        <thead>
                            <tr>
                                <th scope='col'>Nro</th>
                                <th scope='col'>Id Médico</th>
                                <th scope='col'>Nombre Médico</th>
                                <th scope='col'>Id Paciente</th>
                                <th scope='col'>Nombre Paciente</th>
                                <th scope='col'>Apellido Paciente</th>
                                <th scope='col'>Fecha Cita</th>
                                <th scope='col'>Hora Cita</th>
                                <th scope='col'>Estado</th>
                                <th scope='col'>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($consulta = mysqli_fetch_array($resultados)) {
            echo "
                <tr>
                    <td>" . $consulta['idcita'] . "</td>
                    <td>" . $consulta['idmedico'] . "</td>
                    <td>" . $consulta['nombremedico'] . "</td>
                    <td>" . $consulta['idpaciente'] . "</td>
                    <td>" . $consulta['nombre'] . "</td>
                    <td>" . $consulta['apellido'] . "</td>
                    <td>" . $consulta['fechacita'] . "</td>
                    <td>" . $consulta['hora'] . "</td>
                    <td>" . $consulta['estado'] . "</td>
                    <td>
                        <a href='frmregistrarconsulta.php?idpaciente=" . $consulta['idpaciente'] . "' class='btn btn-primary'>Atender Cita</a>
                        <a href='registro.php?idpaciente=" . $consulta['idpaciente'] . "' class='btn btn-warning'>Modificar</a>
                        <a href='eliminar.php?idpaciente=" . $consulta['idpaciente'] . "' class='btn btn-danger'>Eliminar</a>
                    </td>
                </tr>
            ";
        }

        echo "
            </tbody>
        </table>
    </div>
</div>";

?>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>