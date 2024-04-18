<?php

    class View {
        protected $data = array();

        public function __construct($data = array()) {
            $this->data = $data;
        }

        public function render($template) {
            // Cargar el archivo de plantilla y pasar los datos
            include('../views/' . $template . '.php');
        }
    }
?>

