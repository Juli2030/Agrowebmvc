<?php

    // Incluir la clase base del modelo
    require_once 'Model.php';

    class SexoModel extends Model {
        // Método para obtener todos los sexos
        public function obtenerSexos() {
            // Consulta SQL para seleccionar todos los registros de la tabla Sexo
            $query = "SELECT * FROM Sexo";
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
