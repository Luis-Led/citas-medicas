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
	<link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
    
	<script src="jquery3.7.0/jquery-3.7.0.js"></script>
	<script src="popper.min.js"></script>
	<script src="bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
	<script src="java/java.js"></script>

	<script src="SweetAlert/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="SweetAlert/sweetalert2.css">
	<title>Registrar Pacientes</title>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
		<div class="text-center mb-4">
            <h1 class="text-primary">Pacientes</h1>
            <hr class="my-4">
        </div>
	<!-- Encabezado y botón -->
	<div class="container-fluid mt-4">
		<div class="d-flex justify-content-between align-items-center">
			<div class="form-group d-flex align-items-center">
			  <label class="form-label me-2" for="buscar">Buscar:</label>
			  <input type="text" class="form-control" id="buscar" placeholder="Ingrese el C.I a búsqueda">
			</div>
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
				Agregar Nuevo Paciente
			</button>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title" id="staticBackdropLabel">Registrar Paciente</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="registropaciente.php">
						<div class="mb-3">
							<label for="ci" class="form-label">C.I:</label>
							<input type="number" id="ci" class="form-control" placeholder="Introducir C.I" name="ci" required>
						</div>
						<div class="mb-3">
							<label for="nombre" class="form-label">Nombre:</label>
							<input type="text" class="form-control" placeholder="Introducir Nombre" name="nombre" required>
						</div>
						<div class="mb-3">
							<label for="apellido" class="form-label">Apellido:</label>
							<input type="text" class="form-control" placeholder="Introducir Apellido" name="apellido" required>
						</div>
						<div class="mb-3">
							<label for="telefono" class="form-label">Teléfono:</label>
							<input type="number" class="form-control" placeholder="Introducir Teléfono" name="telefono" required>
						</div>
						<div class="mb-3">
							<label for="fechanac" class="form-label">Fecha de Nacimiento:</label>
							<input type="date" class="form-control" id="fechanac" name="fechanac" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Género:</label><br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="genero" id="optionsRadios1" value="M" required>
								<label class="form-check-label" for="optionsRadios1">Masculino</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="genero" id="optionsRadios2" value="F" required>
								<label class="form-check-label" for="optionsRadios2">Femenino</label>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary" name="btnregistrarpaciente">Registrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Tabla de pacientes -->
	<div class="container mt-5">
		<div class="table-responsive">
			<?php
			include("conexion.php");
			$resultados = mysqli_query($conexion, "SELECT * FROM $tabla_db1 WHERE estado='n'");
			echo "<table class=\"table table-hover table-bordered table-dark\">
				<thead class='bg-warning'>
					<tr>
						<th scope='col'>#</th>
						<th scope='col'>CI</th>
						<th scope='col'>Nombre</th>
						<th scope='col'>Apellido</th>
						<th scope='col'>Teléfono</th>
						<th scope='col'>Fecha de Nacimiento</th>
						<th scope='col'>Género</th>
						<th scope='col'>Opciones</th>
					</tr>
				</thead>
				<tbody>";

			while ($consulta = mysqli_fetch_array($resultados)) {
			    echo "<tr>
						<td>{$consulta['idpaciente']}</td>
						<td>{$consulta['ci']}</td>
						<td>{$consulta['nombre']}</td>
						<td>{$consulta['apellido']}</td>
						<td>{$consulta['telefono']}</td>
						<td>{$consulta['fecha_nacimiento']}</td>
						<td>{$consulta['sexo']}</td>
						<td>
							<a class='text-decoration-none text-warning' href='frm_usuario.php?idpaciente={$consulta['idpaciente']}'>Crear Usuario</a> |
							<a class='text-decoration-none text-info' href='registro.php?idpaciente={$consulta['idpaciente']}'>Modificar</a> |
							<a class='text-decoration-none text-danger' href='eliminar.php?idpaciente={$consulta['idpaciente']}'>Eliminar</a>
						</td>
					</tr>";
			}

			echo "</tbody></table>";
			?>
		</div>
	</div>

</body>
</html>
