<?php

$host = getenv('MYSQLHOST');
$port = getenv('MYSQLPORT');
$db   = getenv('MYSQLDATABASE');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD'); // Aquí guardas la contraseña en $pass

// CAMBIA ESTA LÍNEA:
$conexion = new mysqli($host, $user, $pass, $db, $port); 
// Asegúrate de incluir $port, ¡es importante en Railway!

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>