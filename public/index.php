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
$raiz = dirname(__DIR__); 

require $raiz . "/config/database.php";
require $raiz . "/models/usuario.php";
require $raiz . "/models/tareasModels.php";
require $raiz . "/models/notasModels.php";
require $raiz . "/controllers/AuthController.php";
require $raiz . "/controllers/tareasController.php";
require $raiz . "/controllers/notasController.php";
require $raiz . "/controllers/PagoController.php";
require $raiz . "/routes/api.php";
?>