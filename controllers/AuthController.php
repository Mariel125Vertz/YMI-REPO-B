<?php
class AuthController {
    public static function login($conexion){
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data["email"] ?? '';
        $password = $data["password"] ?? '';

        $usuarioModel = new Usuario($conexion);
        $usuario = $usuarioModel->buscarPorCorreo($email);

        if($usuario && password_verify($password, $usuario["password"])){
            echo json_encode([
                "mensaje" => "Login correcto",
                "id_usuario" => $usuario["id_usuario"]
            ]);
        } else {
            echo json_encode(["mensaje" => "Credenciales incorrectas"]);
        }
    }

    public static function registro($conexion) {
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data["email"] ?? '';
        $password = $data["password"] ?? '';

        $usuarioModel = new Usuario($conexion);
        if ($usuarioModel->buscarPorCorreo($email)) {
            echo json_encode(["mensaje" => "El email ya está en uso"]);
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        if ($usuarioModel->registro($email, $passwordHash)) {
            echo json_encode(["mensaje" => "Usuario creado exitosamente"]);
        } else {
            echo json_encode(["mensaje" => "Error al registrar"]);
        }
    }
}