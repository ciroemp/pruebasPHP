<?php
// Incluye el HTML de apertura (<!DOCTYPE html>, <head>, <body>)
include("header.php"); 
// Incluye la conexión a la base de datos ($conexion)
include("database.php"); 

// --- CORRECCIÓN CRÍTICA: SOLO EJECUTAR LA LÓGICA SI EL FORMULARIO FUE ENVIADO (POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Verificar si los campos necesarios existen y tienen contenido
    if (
        isset($_POST['email'], $_POST['password'], $_POST['nombre']) &&
        strlen($_POST['email']) > 1 &&
        strlen($_POST['password']) > 1 &&
        strlen($_POST['nombre']) > 1
    ) {

        // 2. 🚨 SANITIZACIÓN Y HASH DE DATOS
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $email = mysqli_real_escape_string($conexion, $_POST['email']);
        $password = mysqli_real_escape_string($conexion, $_POST['password']);
        
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $fechaReg = date("Y-m-d H:i:s");

        // --- APERTURA DEL CONTENEDOR DE CENTRADO ---
        echo '<div class="vh-100 d-flex justify-content-center align-items-center">';

        // Paso 3: Consulta para verificar si el correo ya existe
        $query_check = "SELECT email FROM datos WHERE email = '$email'";
        // 🔑 CORRECCIÓN DE SINTAXIS EN LA LLAMADA A FUNCIÓN
        $resultado_check = mysqli_query($conexion, $query_check); 

        // Paso 4: Verificar si se encontró alguna fila
        if (mysqli_num_rows($resultado_check) > 0) {

            // ERROR: Correo ya existe (Bloqueado por restricción UNIQUE)
            echo '<div class="card text-center">'; 
            echo '<div class="card-header bg-danger text-white">';
            echo 'AVISO';
            echo '</div>';
            echo '<div class="card-body">';
            echo "<h3 class='bad'>Error: El correo electrónico <b>$email</b> ya está registrado.</h3>";
            echo '<a href="registro.php" class="btn btn-warning">Volver e Intentar de Nuevo</a>'; 
            echo '</div>'; 
            echo '</div>'; 

        } else {
            // Paso 5: Insertar nuevo usuario (ÉXITO o ERROR de DB)
            $consulta = "INSERT INTO datos (nombre, email, password, fecha) 
                          VALUES ('$nombre', '$email', '$password_hashed', '$fechaReg')";

            $resultado = mysqli_query($conexion, $consulta);

            if ($resultado) {
                // ÉXITO: Registro completado
                echo '<div class="card text-center">';
                echo '<div class="card-header bg-success text-white">';
                echo 'AVISO';
                echo '</div>';
                echo '<div class="card-body">';
                echo '<h3 class="ok">¡Te has registrado correctamente!</h3>';
                echo '<a href="index.php" class="btn btn-primary">Siguiente...</a>';
                echo '</div>'; 
                echo '</div>'; 

            } else {
                // ERROR DE BASE DE DATOS (Problema de conexión o sintaxis SQL)
                echo '<div class="card text-center">';
                echo '<div class="card-header bg-danger text-white">';
                echo 'AVISO';
                echo '</div>';
                echo '<div class="card-body">';
                echo '<h3 class="bad">¡Error al registrarse en la base de datos!</h3>';
                echo '<p>Detalle del error: ' . mysqli_error($conexion) . '</p>';
                echo '<a href="registro.php" class="btn btn-danger">Volver</a>';
                echo '</div>'; 
                echo '</div>';
            }
        }
        
        // --- CIERRE DEL CONTENEDOR DE CENTRADO ---
        echo '</div>'; 

    } else {
        // ERROR: Faltan datos en el POST (campos vacíos)
        echo '<h3 class="bad">Error: Faltan datos o son inválidos.</h3>';
    }
} 
// Si NO es POST, el script termina sin imprimir nada, permitiendo que la página cargue limpia.

// Cierra las etiquetas </body> y </html>
include("footer.php"); 
?>