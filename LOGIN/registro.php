<?php
include("header.php");
include("database.php");
?>
<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="card text-center neon" style="width: 350px;">
        <div class="card-header titular">
            <h1>NUEVA CUENTA</h1>
        </div>
        <div class="card-body text-center">
            <form action="newAccount.php" method="post">
                <div class="mb-2"><input type="text" class="form-control" name="nombre" placeholder="Nombre completo" required></div>
                <div class="mb-2"><input type="email" class="form-control" name="email" placeholder="Correo electrónico" required></div>
                <div class="mb-2"><input type="password" class="form-control" name="password" placeholder="Contraseña" required></div>
                <div class="mb-3"><input type="number" class="form-control" name="edad" placeholder="Edad" required></div>
                <input type="submit" class="btn btn-primary w-100 neon-glow" value="Registrar">
            </form>
            <p class="mt-3">
                <a href="index.php">¿Ya tienes cuenta? Inicia Sesión</a>
            </p>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>