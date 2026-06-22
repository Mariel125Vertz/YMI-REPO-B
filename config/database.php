<?php
// Sustituimos getenv por los valores reales que vimos en tu panel de Railway
$host = 'mysql.railway.internal';
$user = 'root';
$pass = 'iSEJuNYrtspXucReBwyYbNnaZxtcmXQU';
$db   = 'railway';
$port = 3306;

// Conexión forzada
$conexion = new mysqli($host, $user, $pass, $db, (int)$port);

if ($conexion->connect_error) {
    // Si sigue fallando, esto nos dirá exactamente qué pasa
    die("Error de conexión: " . $conexion->connect_error . " | Host usado: " . $host);
} else {
    echo "¡Conexión exitosa!";
}
?>