<?php 
$host="localhost";
$base="clmonterrey";
$usuariodb="root";
$clavedb="";

$tabla_db1="paciente";
$tabla_db2="usuario";
$tabla_db4="medico";
// error_reporting(0);
error_reporting(E_ALL);

$conexion= new mysqli($host,$usuariodb,$clavedb,$base);
// echo"exitosos";
if ($conexion->connect_errno) {
    echo "Error de conexión a la base de datos: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
    exit();
} else {
    // echo "Conexión exitosa";
}
?>