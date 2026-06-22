<?php
class Notas {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function agregarNotas($id_usuario, $titulo, $descripcion) {
        $sql = "INSERT INTO notas (id_usuario, titulo, descripcion) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("iss", $id_usuario, $titulo, $descripcion);
        return $stmt->execute();
    }

    public function verNotas($id_usuario) {
        $sql = "SELECT * FROM notas WHERE id_usuario = ?"; // ← faltaba esta línea
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $notas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $notas[] = $fila;
        }
        return $notas;
    }

    public function eliminarNota($id_usuario, $id_notas) {
        $sql = "DELETE FROM notas WHERE id_notas = ? AND id_usuario = ?"; // ← id_notas
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $id_notas, $id_usuario);
        if ($stmt->execute()) {
            return $stmt->affected_rows > 0;
        }
        return false;
    }

    public function editarNota($id_usuario, $id_notas, $titulo, $descripcion) {
        $sql = "UPDATE notas SET titulo = ?, descripcion = ? WHERE id_notas = ? AND id_usuario = ?"; // ← id_notas
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) return false;
        $stmt->bind_param("ssii", $titulo, $descripcion, $id_notas, $id_usuario);
        return $stmt->execute();
    }
}