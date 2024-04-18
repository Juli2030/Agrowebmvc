<?php

require_once '../../config/config.php';

class Model {
    protected $db;

    public function __construct() {
        global $conexion;

        $this->db = $conexion;
    }

    // Otros métodos comunes del modelo pueden ser definidos aquí
}
?>

