<?php

    // Incluir la clase base del modelo
    require_once 'Model.php';

    class RazaModel extends Model {
        // Método para obtener todas las razas
        public function obtenerRazas() {
            // Consulta SQL para seleccionar todos los registros de la tabla Raza
            $query = "SELECT * FROM Raza";
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
