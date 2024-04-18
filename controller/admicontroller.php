<?php
// Incluir el archivo de configuración de la base de datos
include '../../config.php';

// Crear la conexión a la base de datos
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Supongamos que tienes una función para obtener los datos del usuario desde la base de datos
function obtenerDatosUsuario($conexion) {
    // Realiza la consulta para obtener los datos del usuario
    $sql = "SELECT * FROM Usuario WHERE id = 1"; // Suponiendo que el usuario que quieres obtener tiene id 1
    $resultado = $conexion->query($sql);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        // Convertir el resultado en un array asociativo
        $usuario = $resultado->fetch_assoc();
        return $usuario;
    } else {
        return null; // Retorna null si no se encontraron resultados
    }
}

// Llamar a la función para obtener los datos del usuario
$usuario = obtenerDatosUsuario($conexion);

// Incluir la vista para mostrar la información del usuario
include 'administrador.php';

// Cerrar la conexión
$conexion->close();
?>
