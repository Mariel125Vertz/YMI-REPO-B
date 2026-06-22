<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$metodo = $_SERVER['REQUEST_METHOD'];

if ($uri == "/login" && $metodo == "POST") {
    AuthController::login($conexion);

} elseif ($uri == "/registro" && $metodo == "POST") {
    AuthController::registro($conexion);

} elseif (preg_match('#^/agregar-tarea/(\d+)$#', $uri, $matches) && $metodo == "POST") {
    TareasController::crearTarea($conexion, $matches[1]);

} elseif (preg_match('#^/tareas/(\d+)$#', $uri, $matches) && $metodo == "GET") {
    TareasController::verTareas($conexion, $matches[1]);

} elseif (preg_match('#^/eliminar-tarea/(\d+)/(\d+)$#', $uri, $matches) && $metodo == "DELETE") {
    TareasController::eliminarTareas($conexion, $matches[1], $matches[2]);

} elseif (preg_match('#^/editar-tarea/(\d+)/(\d+)$#', $uri, $matches) && $metodo == "PUT") {
    TareasController::editarTareas($conexion, $matches[1], $matches[2]);

} elseif (preg_match('#^/agregar-nota/(\d+)$#', $uri, $matches) && $metodo == "POST") {
    NotasController::crearNotas($conexion, $matches[1]);

} elseif (preg_match('#^/eliminar-nota/(\d+)/(\d+)$#', $uri, $matches) && $metodo == "DELETE") {
    NotasController::eliminarNota($conexion, $matches[1], $matches[2]);

} elseif (preg_match('#^/editar-nota/(\d+)/(\d+)$#', $uri, $matches) && $metodo == "PUT") {
    NotasController::editarNota($conexion, $matches[1], $matches[2]);

} elseif (preg_match('#^/notas/(\d+)$#', $uri, $matches) && $metodo == "GET") {
    NotasController::verNotas($conexion, $matches[1]);

} elseif ($uri == "/crear-preferencia" && $metodo == "POST") {
    PagoController::crearSesionStripe();

} elseif (preg_match('#^/activar-premium/(\d+)$#', $uri, $matches) && $metodo == "POST") {
    PagoController::activarPremium($conexion, $matches[1]);

} elseif (preg_match('#^/es-premium/(\d+)$#', $uri, $matches) && $metodo == "GET") {
    PagoController::verificarPremium($conexion, $matches[1]);

} else {
    http_response_code(404);
    echo json_encode(["error" => "Ruta no encontrada"]);
}