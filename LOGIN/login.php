<?php
    include("database.php");


if (strlen($_POST['email']) > 1 && strlen($_POST['password']) > 1) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fechaReg = date("Y-m-d H:i:s");

    $consulta = "INSERT INTO `datos`(nombre, email, fecha) VALUES ('$nombre','$email','$fechaReg'')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        ?> <h3 class="ok">¡Te has registrado correctamente!</h3> <?php
    } else {
        ?> <h3 class="bad">¡Error al registrarse!</h3> <?php
    }
}

?>