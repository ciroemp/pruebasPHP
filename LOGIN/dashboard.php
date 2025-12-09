<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
include("header.php");
?>
<div class="vh-100 d-flex justify-content-center align-items-center bg-light">
    <div class="card text-center p-5 shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2>Panel de Control</h2>
        </div>
        <div class="card-body">
            <h3>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_nombre']); ?></h3>
            <p class="text-muted"><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
            <hr>
            <p class="lead">Estás dentro del sistema seguro.</p>
            <a href="logout.php" class="btn btn-danger mt-3">Cerrar Sesión</a>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>