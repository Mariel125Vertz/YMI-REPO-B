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


$baseDir = dirname(__DIR__); 
require $baseDir . "/config/database.php";
require $baseDir . "/models/usuario.php";
require $baseDir . "/models/tareasModels.php";
require $baseDir . "/models/notasModels.php";
require $baseDir . "/controllers/AuthController.php";
require $baseDir . "/controllers/tareasController.php";
require $baseDir . "/controllers/notasController.php";
require $baseDir . "/controllers/PagoController.php";
require $baseDir . "/routes/api.php";
