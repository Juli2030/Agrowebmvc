<?php

    // Función para verificar si un usuario está autenticado
    function verificarAutenticacion() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            // Si el usuario no está autenticado, redirigir al formulario de inicio de sesión
            redirect('../views/auth/login.php');
        }
    }

    // Función para verificar si un usuario es administrador
    function esAdministrador() {
        session_start();
        if ($_SESSION['rol'] !== 'administrador') {
            // Si el usuario no es administrador, redirigir a una página de acceso denegado o mostrar un mensaje de error
            echo "Acceso denegado: esta funcionalidad está reservada para administradores.";
            exit();
        }
    }

    // Función para cargar una vista
    function cargarVista($ruta) {
        include('../views/' . $ruta . '.php');
    }

    // Función para obtener la URL base del sitio
    function obtenerURLBase() {
        $protocolo = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === false ? 'http' : 'https';
        $host = $_SERVER['HTTP_HOST'];
        $ruta = dirname($_SERVER['PHP_SELF']);
        return $protocolo . '://' . $host . $ruta;
    }

    // Función para generar una cadena aleatoria (por ejemplo, para generar tokens de sesión)
    function generarCadenaAleatoria($longitud = 10) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $cadenaAleatoria = '';
        for ($i = 0; $i < $longitud; $i++) {
            $indice = rand(0, strlen($caracteres) - 1);
            $cadenaAleatoria .= $caracteres[$indice];
        }
        return $cadenaAleatoria;
    }
?>