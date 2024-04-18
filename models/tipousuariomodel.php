<?php

    // Incluir la clase base del modelo
    require_once 'Model.php';

    class TipoUsuarioModel extends Model {
        // Método para obtener todos los tipos de usuarios
        public function obtenerTiposUsuarios() {
            // Consulta SQL para seleccionar todos los registros de la tabla Tipo_usuario
            $query = "SELECT * FROM Tipo_usuario";
            // Preparar la consulta
            $statement = $this->db->prepare($query);
            // Ejecutar la consulta
            $statement->execute();
            // Devolver todos los resultados como un arreglo asociativo
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        // Otros métodos según sea necesario
    }
?>
