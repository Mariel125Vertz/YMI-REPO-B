<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$base = dirname(__DIR__); 

// Construimos la ruta absoluta correctamente, sin doble barra
require "/app/config/database.php";
require $base . "/models/usuario.php";
require $base . "/models/tareasModels.php";
require $base . "/models/notasModels.php";
require $base . "/controllers/AuthController.php";
require $base . "/controllers/tareasController.php";
require $base . "/controllers/notasController.php";
require $base . "/controllers/PagoController.php";
require $base . "/routes/api.php";