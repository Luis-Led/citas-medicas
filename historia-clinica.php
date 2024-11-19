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
    <title>Historia Clínica Pacientes</title>
    <link rel="stylesheet" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="text-primary">Historia Clínica de Pacientes</h1>
            <hr class="my-4">
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="d-flex mb-4" method="POST" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" id="nombre" name="busqueda" placeholder="Buscar por CI" required>
                        <button type="submit" class="btn btn-primary" name="btn2">Buscar</button>
                    </div>
                </form>

                <?php 
                if (isset($_POST['btn2'])) {
                    include("conexion.php");
                    $busqueda = $_POST['busqueda'];
                    $bconsulta = mysqli_query($conexion, "SELECT * FROM paciente WHERE ci LIKE '%$busqueda%'");

                    echo "<ul class='list-group'>";
                    while ($busca = mysqli_fetch_array($bconsulta)) {
                        echo "<li class='list-group-item'>CI: " . $busca['ci'] . "</li>";
                    }
                    echo "</ul>";
                }
                ?>
            </div>
        </div>

        <div class="table-responsive mt-5">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">Nro</th>
                        <th class="text-center">CI</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellido</th>
                        <th class="text-center">Sexo</th>
                        <th class="text-center">Por Atender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("conexion.php");
                    $idmed = $_SESSION['idmedico'];
                    $resultados = mysqli_query($conexion, "SELECT * FROM paciente");

                    while ($consulta = mysqli_fetch_array($resultados)) {
                        echo "<tr>
                                <td class='text-center'>" . $consulta['idpaciente'] . "</td>
                                <td class='text-center'>" . $consulta['ci'] . "</td>
                                <td class='text-center'>" . $consulta['nombre'] . "</td>
                                <td class='text-center'>" . $consulta['apellido'] . "</td>
                                <td class='text-center'>" . $consulta['sexo'] . "</td>
                                <td class='text-center'>
                                    <a href='frmhistorial.php?idpaciente=" . $consulta['idpaciente'] . "' class='btn btn-primary btn-sm'>Ver Historia Clínica</a>
                                </td>
                            </tr>";
                    }
                    mysqli_close($conexion);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>