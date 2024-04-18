<?php

    class Controller {
        protected $model;

        public function __construct($model) {
            // Inicializar la instancia del modelo
            $this->model = $model;
        }

        protected function loadView($view, $data = array()) {
            // Cargar la vista especificada
            // Puedes pasar datos a la vista como un arreglo asociativo
            include('../views/' . $view . '.php');
        }

        protected function loadModel($name) {
            // Cargar el modelo especificado
            // Por ejemplo:
            // include('../models/' . $name . '.php');
            // return new $name();
            // Aquí asumimos que los nombres de archivo del modelo corresponden a los nombres de clase
            // y que están ubicados en la carpeta models
        }

        protected function redirect($url) {
            // Redirigir a una URL específica
            header('Location: ' . $url);
            exit();
        }

        protected function cleanInput($input) {
            // Limpiar y validar los datos del formulario
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
    }
?>
