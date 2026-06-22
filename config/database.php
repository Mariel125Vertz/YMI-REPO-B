<?php

$host = "mysql.railway.internal"; 
$user = "root";                   
$password = "eRdvKWXQghcOoZwrwQQzwJOAnYDoiga"; 
$db = "railway";                
$port = 3306;

$conexion = new mysqli($host, $user, $password, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>