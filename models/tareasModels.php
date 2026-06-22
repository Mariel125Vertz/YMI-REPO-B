<?php
class Tareas {
    private $conexion;
    public function __construct($conexion){
        $this->conexion = $conexion;
    }

    public function agregarTarea($id_usuario, $nombre, $fecha, $prioridad, $descripcion){
        $sql = "INSERT INTO tareas (id_usuario, nombre, fecha_entrega, prioridad, descripcion) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("issss", $id_usuario, $nombre, $fecha, $prioridad, $descripcion);
        return $stmt->execute();
    }

   public function verTrea($id_usuario) {
    $sql = "SELECT * FROM tareas WHERE id_usuario = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $tareas = [];
    while ($fila = $resultado->fetch_assoc()) { $tareas[] = $fila; }
    return $tareas;
}

   public function eliminarTarea($id_usuario, $id_tarea) {
        $sql = "DELETE FROM tareas WHERE id_tarea = ? AND id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("ii", $id_tarea, $id_usuario);
        
        if ($stmt->execute()) {
            return $stmt->affected_rows > 0; 
        }
        
        return false;
    }


   public function editarTarea($id_tarea, $id_usuario, $nombre, $fecha, $prioridad, $descripcion) {
         $sql = "UPDATE tareas 
            SET nombre = ?, fecha_entrega = ?, prioridad = ?, descripcion = ? 
            WHERE id_tarea = ? AND id_usuario = ?";
         $stmt = $this->conexion->prepare($sql);
    
        if (!$stmt) {
        return false;
         }
        $stmt->bind_param("ssssii", $nombre, $fecha, $prioridad, $descripcion, $id_tarea, $id_usuario);
        if ($stmt->execute()) {
        return true; 
         }
      return false;
}

}



