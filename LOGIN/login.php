<?php
include("header.php"); 
include("database.php");
session_start();

// Si no es POST, fuera de aquí
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<script>window.location.href="index.php";</script>';
    exit();
}

echo '<div class="vh-100 d-flex justify-content-center align-items-center">';

if (isset($_POST['email'], $_POST['password'])) {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    $query = "SELECT id, nombre, password FROM datos WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        
        if (password_verify($password, $usuario['password'])) {
            // LOGIN EXITOSO
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_nombre'] = $usuario['nombre'];
            $_SESSION['user_email'] = $email;
            
            echo '<div class="card text-center">';
            echo '<div class="card-header bg-success text-white">¡BIENVENIDO!</div>';
            echo '<div class="card-body">';
            echo "<h3 class='ok'>Hola, {$usuario['nombre']}</h3>";
            echo '<p>Redirigiendo al panel...</p>';
            echo '<meta http-equiv="refresh" content="2;url=dashboard.php">'; 
            echo '</div></div>';
        } else {
            showError("Contraseña incorrecta.", "index.php");
        }
    } else {
        showError("El correo no está registrado.", "index.php");
    }
} else {
    showError("Faltan datos.", "index.php");
}

echo '</div>';

function showError($msg, $link) {
    echo '<div class="card text-center"><div class="card-header bg-danger text-white">ERROR</div>';
    echo '<div class="card-body"><h3 class="bad">' . $msg . '</h3>';
    echo '<a href="' . $link . '" class="btn btn-warning">Intentar de nuevo</a></div></div>';
}

include("footer.php");
?>