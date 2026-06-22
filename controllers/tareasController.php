<?php
class TareasController { 

    public static function crearTarea($conexion, $id_usuario) {
        $data = json_decode(file_get_contents("php://input"), true);
        
        $nombre      = $data["nombre"]       ?? '';
        $fecha       = $data["fecha_entrega"] ?? '';
        $prioridad   = $data["prioridad"]    ?? '';
        $descripcion = $data["descripcion"]  ?? '';

        $usuarioModel = new Usuario($conexion);
        if (!$usuarioModel->buscarPorId($id_usuario)) {
            http_response_code(404);
            echo json_encode(["mensaje" => "Error: Usuario no encontrado"]);
            return;
        }

        $tareaModel = new Tareas($conexion);
        if ($tareaModel->agregarTarea($id_usuario, $nombre, $fecha, $prioridad, $descripcion)) {
            echo json_encode([
                "mensaje" => "Tarea agregada exitosamente",
                "id" => $conexion->insert_id  
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al agregar la tarea"]);
        }
    }

    public static function verTareas($conexion, $id_usuario) {
        $usuarioModel = new Usuario($conexion);
        if (!$usuarioModel->buscarPorId($id_usuario)) {
            http_response_code(404);
            echo json_encode(["mensaje" => "Error: Usuario no encontrado"]);
            return;
        }
        $tareaModel = new Tareas($conexion);
        $listaTareas = $tareaModel->verTrea($id_usuario);
        http_response_code(200);
        echo json_encode($listaTareas);
    }

    public static function eliminarTareas($conexion, $id_usuario, $id_tarea) {
        $tareaModel = new Tareas($conexion);
        if ($tareaModel->eliminarTarea($id_usuario, $id_tarea)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Tarea eliminada exitosamente"]);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Error: Tarea no encontrada o no tienes permisos"]);
        }
    }

   public static function editarTareas($conexion, $id_usuario, $id_tarea) { 
    $data = json_decode(file_get_contents("php://input"), true);
    
    $nombre       = $data["nombre"]       ?? '';
    $fecha        = $data["fecha_entrega"] ?? '';
    $prioridad    = $data["prioridad"]     ?? '';
    $descripcion  = $data["descripcion"]   ?? '';


    $tareaModel = new Tareas($conexion);
    if ($tareaModel->editarTarea($id_tarea, $id_usuario, $nombre, $fecha, $prioridad, $descripcion)) {
        http_response_code(200);
        echo json_encode(["mensaje" => "Tarea editada correctamente"]); 
    } else {
        http_response_code(404); 
        echo json_encode(["mensaje" => "Upps no se encontro la tarea que buscas"]);
    }
}
}