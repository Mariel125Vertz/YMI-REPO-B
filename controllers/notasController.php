<?php

class NotasController {

    public static function crearNotas($conexion, $id_usuario) {
        $data = json_decode(file_get_contents("php://input"), true);

        $titulo      = $data["titulo"]      ?? '';
        $descripcion = $data["descripcion"] ?? '';

        $usuarioModel = new Usuario($conexion);
        if (!$usuarioModel->buscarPorId($id_usuario)) {
            http_response_code(404);
            echo json_encode(["mensaje" => "El usuario no existe"]);
            return;
        }

        $notaModel = new Notas($conexion);
        if ($notaModel->agregarNotas($id_usuario, $titulo, $descripcion)) {
            echo json_encode([
                "mensaje" => "Nota agregada exitosamente",
                "id" => $conexion->insert_id  // ← para poder editar/eliminar desde el frontend
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error en el servidor"]);
        }
    }

    public static function verNotas($conexion, $id_usuario) {
        $usuarioModel = new Usuario($conexion);
        if (!$usuarioModel->buscarPorId($id_usuario)) {
            http_response_code(404);
            echo json_encode(["mensaje" => "El usuario no existe"]);
            return;
        }

        $notaModel = new Notas($conexion);
        $listaNotas = $notaModel->verNotas($id_usuario);
        http_response_code(200);
        echo json_encode($listaNotas);
    }

    public static function eliminarNota($conexion, $id_usuario, $id_nota) {
        $notaModel = new Notas($conexion);
        if ($notaModel->eliminarNota($id_usuario, $id_nota)) {
            echo json_encode(["mensaje" => "Nota eliminada exitosamente"]);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Nota no encontrada o sin permisos"]);
        }
    }

    public static function editarNota($conexion, $id_usuario, $id_nota) {
        $data = json_decode(file_get_contents("php://input"), true);

        $titulo      = $data["titulo"]      ?? '';
        $descripcion = $data["descripcion"] ?? '';

        $notaModel = new Notas($conexion);
        if ($notaModel->editarNota($id_usuario, $id_nota, $titulo, $descripcion)) {
            echo json_encode(["mensaje" => "Nota actualizada exitosamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al actualizar"]);
        }
    }
}