<?php

    // Incluir la clase base del modelo
    require_once 'Model.php';

    class ProduccionLecheraModel extends Model {
        // Método para obtener todas las producciones lecheras
        public function obtenerProduccionesLecheras() {
            // Consulta SQL para seleccionar todos los registros de la tabla Produccion_lechera
            $query = "SELECT * FROM Produccion_lechera";
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
