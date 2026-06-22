<?php

$host = "localhost";
$user = "root";
$password = "mariloks";
$db = "notion";

$conexion = new mysqli($host, $user, $password, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>