<?php
include("header.php");
include("database.php");

// Lógica de envío (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    echo '<div class="vh-100 d-flex justify-content-center align-items-center">';
    
    $query = "SELECT id FROM datos WHERE email = '$email'";
    $res = mysqli_query($conexion, $query);

    if ($res && mysqli_num_rows($res) === 1) {
        $usuario = mysqli_fetch_assoc($res);
        $token = bin2hex(random_bytes(16)); 
        $expiry = date('Y-m-d H:i:s', time() + 3600); // 1 hora

        $update = "UPDATE datos SET reset_token = '$token', token_expiry = '$expiry' WHERE id = " . $usuario['id'];
        mysqli_query($conexion, $update);

        // Generar enlace
        $link = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/resetear_password.php?token=$token&email=$email";
        
        // Simulación de correo
        echo '<div class="card text-center"><div class="card-header bg-success text-white">ENVIADO</div>';
        echo '<div class="card-body"><h3>Revisa tu correo</h3><p>Hemos enviado un enlace de recuperación.</p>';
        echo '<p class="small text-muted bg-light p-2 border">LINK (Simulación): <a href="'.$link.'">Resetear Password</a></p>';
        echo '<a href="index.php" class="btn btn-primary">Volver al Login</a></div></div>';
    } else {
        echo '<div class="card text-center"><div class="card-header bg-danger text-white">ERROR</div>';
        echo '<div class="card-body"><h3>Correo no encontrado</h3><a href="recuperar_password.php" class="btn btn-warning">Intentar de nuevo</a></div></div>';
    }
    echo '</div>';
} else {
    // Formulario (GET)
?>
<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="card p-4 shadow-lg" style="width: 400px;">
        <h3 class="text-center mb-3">Recuperar Contraseña</h3>
        <form method="POST" action="recuperar_password.php">
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Ingresa tu correo" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Enviar Enlace</button>
            <p class="mt-3 text-center"><a href="index.php">Cancelar</a></p>
        </form>
    </div>
</div>
<?php 
}
include("footer.php");
?>