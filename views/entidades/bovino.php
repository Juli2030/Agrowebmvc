<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/csspro/bovinos.css">
    <title>Registro de Bovinos</title>
</head>
<body>
    <form action="procesar_formulario.php" method="POST" enctype="multipart/form-data">
        <h2>Registro de Bovinos</h2>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="edad">Edad:</label>
            <input type="text" id="edad" name="edad" required>
        </div>
        <div class="form-group">
            <label for="raza">Raza:</label>
            <select id="raza" name="raza" required>
                <option value="">Seleccionar Raza</option>
                <option value="1">Raza 1</option>
                <option value="2">Raza 2</option>
                <option value="3">Raza 3</option>
                <!-- Agrega más opciones según tus razas -->
            </select>
        </div>
        <div class="form-group">
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="">Seleccionar Sexo</option>
                <option value="1">Macho</option>
                <option value="2">Hembra</option>
            </select>
        </div>
        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*">
        </div>
        <button type="submit" class="btn">Registrar Bovino</button>
    </form>
    <footer>
        <p>Todos los derechos reservados ® AgroConectaWeb 2024</p>
    </footer>
</body>
</html>
