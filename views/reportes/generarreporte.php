<?php

require_once '../../config/config.php'; // Asegúrate de incluir el archivo de configuración de la base de datos

// Función para generar informe individual de producción de leche
function generateIndividualMilkProductionReport($userId) {
    global $conexion;

    // Consulta para obtener la producción de leche del usuario específico
    $query = "SELECT Fecha_ordeño, Cantidad_litros, Novedades FROM Produccion_lechera WHERE Id_usuario = :userId";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Procesar los resultados y generar el informe
    $report = "<h3>Informe de producción de leche para el usuario con ID $userId:</h3>";
    $report .= "<table border='1'><tr><th>Fecha de ordeño</th><th>Cantidad de leche</th><th>Novedades</th></tr>";
    foreach ($results as $row) {
        $report .= "<tr><td>" . $row['Fecha_ordeño'] . "</td><td>" . $row['Cantidad_litros'] . " litros</td><td>" . $row['Novedades'] . "</td></tr>";
    }
    $report .= "</table>";

    return $report;
}

// Función para generar informe grupal de producción de leche
function generateGroupMilkProductionReport() {
    global $conexion;

    // Consulta para obtener la producción de leche de todos los usuarios
    $query = "SELECT Id_usuario, Fecha_ordeño, Cantidad_litros, Novedades FROM Produccion_lechera";
    $statement = $conexion->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Procesar los resultados y generar el informe
    $report = "<h3>Informe de producción de leche grupal:</h3>";
    $report .= "<table border='1'><tr><th>Usuario ID</th><th>Fecha de ordeño</th><th>Cantidad de leche</th><th>Novedades</th></tr>";
    foreach ($results as $row) {
        $report .= "<tr><td>" . $row['Id_usuario'] . "</td><td>" . $row['Fecha_ordeño'] . "</td><td>" . $row['Cantidad_litros'] . " litros</td><td>" . $row['Novedades'] . "</td></tr>";
    }
    $report .= "</table>";

    return $report;
}

// Ejemplo de uso de las funciones
$individualReport = generateIndividualMilkProductionReport(1); // Generar informe individual para el usuario con ID 1
$groupReport = generateGroupMilkProductionReport(); // Generar informe grupal

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes de producción de leche</title>
    <link rel="stylesheet" href="../../public/csspro/reportes.css">
</head>
<body>
    <?php echo $individualReport; ?>
    <?php echo $groupReport; ?>
</body>
</html>
