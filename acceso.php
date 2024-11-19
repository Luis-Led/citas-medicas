<?php
    session_start();
    ob_start();
    if (isset($_POST['btn_index'])) {
        $_SESSION['sesion_extito']=0;
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        if ($user==""||$pass=="") {
            #header('Location:index.php')
            $_SESSION['sesion_exito']=2;//error de capos vacios
        }
        else{
            include('conexion.php');
            $_SESSION['sesion_exito']=3;//datos incorrectos
            $resultado=mysqli_query($conexion,"SELECT * FROM  $tabla_db2 WHERE usuario ='$user' AND pass ='$pass'");
            while ($consulta=mysqli_fetch_array($resultado)) {
                $_SESSION['sesion_exito']=1;//inicio de sesion
                $_SESSION['usuario']=$consulta[0];
                $_SESSION['tipo']=$consulta[2];
                $_SESSION['idpaciente']=$consulta[3];
                $_SESSION['idmedico']=$consulta[5];

                header('Location: principal.php');
                exit();
            }
            mysqli_close($conexion);
        }
        // Redireccionar para evitar el reenvío del formulario al actualizar
        header('Location: index.php');
        exit();
    }
    if ($_SESSION['sesion_exito']!=1) {
        header('Location:index.php');
        mysqli_close($conexion);
    }
    else{
        header('Location:principal.php');
    }
?>  