<?php
include("database.php");

if (isset($_POST['email'], $_POST['password'], $_POST['nombre']) &&
    strlen($_POST['email']) > 1 &&
    strlen($_POST['password']) > 1 &&
    strlen($_POST['nombre']) > 1) {

    $nombre   = $_POST['nombre'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $fechaReg = date("Y-m-d H:i:s");

    $consulta = "INSERT INTO datos (nombre, email, password, fecha) 
                 VALUES ('$nombre', '$email', '$password', '$fechaReg')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo '<h3 class="ok">¡Te has registrado correctamente!</h3>';
    } else {
        echo '<h3 class="bad">¡Error al registrarse!</h3>';
    }
}
?>
