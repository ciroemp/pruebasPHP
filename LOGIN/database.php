<?php

$conexion = mysqli_connect("localhost:3307", "root", "", "Registro");

if ($conexion) {
    echo "TODO CORRECTO";
}   

?>

<!--

ALTER TABLE `datos`
ADD CONSTRAINT unique_email UNIQUE (email);

-->