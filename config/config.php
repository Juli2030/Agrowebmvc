<?php
// Definir constantes para la conexión a la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'agroconectaweb');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    // Crear una instancia de la conexión PDO
    $conexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Establecer el modo de error PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Opcional: Configurar el juego de caracteres a UTF-8
    $conexion->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // Mostrar mensaje de error en caso de que la conexión falle
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    exit();
}
?>




