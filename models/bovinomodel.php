<?php

    // Incluir la clase base del modelo
    require_once 'Model.php';

    class BovinoModel extends Model {
        // Método para obtener todos los bovinos
        public function obtenerBovinos() {
            // Consulta SQL para seleccionar todos los registros de la tabla Bovino
            $query = "SELECT * FROM Bovino";
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
