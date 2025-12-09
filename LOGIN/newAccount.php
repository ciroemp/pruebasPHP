<?php
include("header.php");
include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['password'], $_POST['nombre'], $_POST['edad'])) {
        
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $email = mysqli_real_escape_string($conexion, $_POST['email']);
        $password = mysqli_real_escape_string($conexion, $_POST['password']);
        $edad = mysqli_real_escape_string($conexion, $_POST['edad']); 
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $fechaReg = date("Y-m-d H:i:s");

        echo '<div class="vh-100 d-flex justify-content-center align-items-center">';

        $query_check = "SELECT email FROM datos WHERE email = '$email'";
        $resultado_check = mysqli_query($conexion, $query_check);

        // CORRECCIÓN: Verificar que la consulta se ejecutó bien antes de contar filas
        if ($resultado_check && mysqli_num_rows($resultado_check) > 0) {
            // Error: Duplicado
            echo '<div class="card text-center"><div class="card-header bg-danger text-white">AVISO</div>';
            echo '<div class="card-body"><h3 class="bad">El correo <b>' . $email . '</b> ya existe.</h3>';
            echo '<a href="registro.php" class="btn btn-warning">Volver</a></div></div>';
        } else {
            // Insertar
            $consulta = "INSERT INTO datos (nombre, email, password, edad, fecha) VALUES ('$nombre', '$email', '$password_hashed', '$edad', '$fechaReg')";
            
            if (mysqli_query($conexion, $consulta)) {
                echo '<div class="card text-center"><div class="card-header bg-success text-white">EXITO</div>';
                echo '<div class="card-body"><h3 class="ok">¡Registro completado!</h3>';
                echo '<a href="index.php" class="btn btn-primary">Iniciar Sesión</a></div></div>';
            } else {
                echo '<div class="card text-center"><div class="card-header bg-danger text-white">ERROR BD</div>';
                echo '<div class="card-body"><p>' . mysqli_error($conexion) . '</p><a href="registro.php" class="btn btn-danger">Volver</a></div></div>';
            }
        }
        echo '</div>';
    }
} else {
    echo '<script>window.location.href="registro.php";</script>';
}
include("footer.php");
?>