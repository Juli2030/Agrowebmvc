<?php

    // Incluir la clase base del modelo
    require_once 'Model.php';

    class FrecuenciaCardiacaModel extends Model {
        // Método para obtener todas las frecuencias cardíacas
        public function obtenerFrecuenciasCardiacas() {
            // Consulta SQL para seleccionar todos los registros de la tabla Frecuencia_cardiaca
            $query = "SELECT * FROM Frecuencia_cardiaca";
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
