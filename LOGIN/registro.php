<?php
// Incluye el HTML de apertura (<!DOCTYPE html>, <head>, <body>)
include("header.php"); 
// Incluye la conexión a la base de datos ($conexion)
include("database.php"); 

?>


    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="card text-center">
            <div class="card-header">
                <h1>REGISGTRO</h1>
            </div>

            <div class="card-body text-center">
                <form action="login.php" method="post">
                    <input type="text" name="nombre" placeholder="...NOMBRE">
                    <input type="email" name="email" placeholder="...MAIL">
                    <input type="text" name="password" placeholder="...PASSWORD">
                    <input type="number" name="edad" placeholder="...EDAD">
                    <input type="submit" value="Send">
                </form>

                <?php
                include("login.php");
                ?>
            </div>
        </div>


<?php
include("footer.php");
?>