<?php
class Usuario {
    private $conexion;
    public function __construct($conexion) { $this->conexion = $conexion; }

    public function buscarPorCorreo($email) {
        $sql = "SELECT id_usuario, password FROM usuarios WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function buscarPorId($id) {
        $sql = "SELECT id_usuario FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function registro($email, $passwordHash) {
        $sql = "INSERT INTO usuarios (email, password) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ss", $email, $passwordHash);
        return $stmt->execute();
    }
    public function hacerPremium($id_usuario) {
    $sql = "UPDATE usuarios SET es_premium = 1 WHERE id_usuario = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    return $stmt->execute();
}

public function esPremium($id_usuario) {
    $sql = "SELECT es_premium FROM usuarios WHERE id_usuario = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
    return $resultado && $resultado['es_premium'] == 1;
}
}