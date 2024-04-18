<?php

    // Incluir la clase base del modelo
    require_once 'Model.php';

    class GeolocalizacionModel extends Model {
        // Método para obtener todas las geolocalizaciones
        public function obtenerGeolocalizaciones() {
            // Consulta SQL para seleccionar todos los registros de la tabla Geolocalizacion
            $query = "SELECT * FROM Geolocalizacion";
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
