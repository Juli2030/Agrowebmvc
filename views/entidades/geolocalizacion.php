<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/csspro/geolocalizacion.css">
    <title>Registro de Bovinos con Geolocalización</title>
</head>
<body>
    <form action="procesar_formulario.php" method="POST" enctype="multipart/form-data">
        <h2>Registro de Bovinos con Geolocalización</h2>
        <div class="form-group">
            <label for="id_bovino">ID Bovino:</label>
            <input type="text" id="id_bovino" name="id_bovino" required>
        </div>
        <div class="form-group">
            <label for="latitud">Latitud:</label>
            <input type="text" id="latitud" name="latitud" required>
        </div>
        <div class="form-group">
            <label for="longitud">Longitud:</label>
            <input type="text" id="longitud" name="longitud" required>
        </div>
        <div class="form-group">
            <label for="hora_alerta">Hora GMT de la alerta:</label>
            <input type="text" id="hora_alerta" name="hora_alerta" required>
        </div>
        <div class="form-group">
            <label for="fecha_alerta">Fecha de la alerta:</label>
            <input type="date" id="fecha_alerta" name="fecha_alerta" required>
        </div>
        <button type="submit" class="btn">Registrar Bovino con Geolocalización</button>
    </form>
    <footer>
        <p>Todos los derechos reservados ® AgroConectaWeb 2024</p>
    </footer>
</body>
</html>
