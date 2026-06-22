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

require "/config/database.php";
require "/models/usuario.php";
require "/models/tareasModels.php";
require "/models/notasModels.php";
require "/controllers/AuthController.php";
require "/controllers/tareasController.php";
require "/controllers/notasController.php";
require "/controllers/PagoController.php";
require "/routes/api.php";