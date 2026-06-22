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


$root = dirname(__DIR__); 
require $root . "/config/database.php";
require $root . "/models/usuario.php";
require $root . "/models/tareasModels.php";
require $root . "/models/notasModels.php";
require $root . "/controllers/AuthController.php";
require $root . "/controllers/tareasController.php";
require $root . "/controllers/notasController.php";
require $root . "/controllers/PagoController.php";
require $root . "/routes/api.php";
