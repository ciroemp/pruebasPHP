<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="card text-center neon" style="width: 350px;">
            <div class="card-header titular">
                <h1>INICIO DE SESIÓN</h1>
            </div>
            <div class="card-body text-center">
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    </div>
                    <input type="submit" class="btn w-100 neon-glow" value="Entrar">
                </form>
                <div class="mt-3">
                    <a href="registro.php" class="d-block mb-1">¿Necesitas registrarte?</a>
                    <a href="recuperar_password.php" class="d-block text-secondary small">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>