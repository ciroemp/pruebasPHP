<?php
include("header.php");
include("database.php");

$token = isset($_REQUEST['token']) ? mysqli_real_escape_string($conexion, $_REQUEST['token']) : '';
$email = isset($_REQUEST['email']) ? mysqli_real_escape_string($conexion, $_REQUEST['email']) : '';

// Validar token
$sql = "SELECT id FROM datos WHERE email = '$email' AND reset_token = '$token' AND token_expiry > NOW()";
$res = mysqli_query($conexion, $sql);
$valido = ($res && mysqli_num_rows($res) === 1);
$user_id = $valido ? mysqli_fetch_assoc($res)['id'] : null;

echo '<div class="vh-100 d-flex justify-content-center align-items-center">';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $valido) {
    if (isset($_POST['password']) && strlen($_POST['password']) >= 4) {
        $new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $update = "UPDATE datos SET password = '$new_pass', reset_token = NULL, token_expiry = NULL WHERE id = $user_id";
        if (mysqli_query($conexion, $update)) {
            echo '<div class="card text-center"><div class="card-header bg-success text-white">EXITO</div>';
            echo '<div class="card-body"><h3>Contraseña cambiada</h3><a href="index.php" class="btn btn-primary">Iniciar Sesión</a></div></div>';
        }
    } else {
        echo '<div class="card"><div class="card-body"><h3>La contraseña es muy corta</h3><a href="javascript:history.back()" class="btn btn-warning">Volver</a></div></div>';
    }
} elseif ($valido) {
    // Formulario para poner nueva pass
    ?>
    <div class="card p-4 shadow-lg" style="width: 400px;">
        <h3 class="text-center">Nueva Contraseña</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Nueva contraseña" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
        </form>
    </div>
    <?php
} else {
    echo '<div class="card text-center"><div class="card-header bg-danger text-white">ERROR</div>';
    echo '<div class="card-body"><h3>Enlace inválido o expirado.</h3><a href="recuperar_password.php" class="btn btn-primary">Solicitar nuevo</a></div></div>';
}

echo '</div>';
include("footer.php");
?>