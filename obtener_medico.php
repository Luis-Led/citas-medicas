<?php
    include('conexion.php');
    // Obtener la especialidad seleccionada
    $esp = $_POST["especialidad"];
    // Obtener los médicos correspondientes
    $medico=mysqli_query($conexion,"SELECT * FROM medico WHERE idespecialidad='$esp'");
    while ($md=mysqli_fetch_array($medico)) 
    {
        echo "<option value='$md[0]'>$md[2]</option>";
    }
    
?>