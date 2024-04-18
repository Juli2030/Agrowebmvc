<?php
// Incluir el archivo de configuración de la base de datos
require_once '../../config/config.php';

// Verificar si hay una sesión iniciada
session_start();
if (!isset($_SESSION['user_id'])) {
    // Si no hay sesión iniciada, redirigir al usuario al formulario de inicio de sesión
    header("Location: ../../index.php");
    exit();
}

// Obtener el ID de usuario de la sesión actual
$user_id = $_SESSION['user_id'];

// Crear la conexión a la base de datos
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener el nombre de usuario a partir del ID
$sql = "SELECT Usuario FROM usuario WHERE Id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre_usuario = $row['Usuario'];
} else {
    $nombre_usuario = "Usuario no encontrado";
}

// Función para obtener los datos del usuario por su nombre de usuario
function obtenerDatosUsuario($conexion, $username) {
    // Realiza la consulta para obtener los datos del usuario por su nombre de usuario
    $sql = "SELECT * FROM usuario WHERE Usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se encontraron resultados
    if ($resultado && $resultado->num_rows > 0) {
        // Convertir el resultado en un array asociativo
        $usuario = $resultado->fetch_assoc();
        return $usuario;
    } else {
        return null; // Retorna null si no se encontraron resultados
    }
}

// Llamar a la función para obtener los datos del usuario
$usuario = obtenerDatosUsuario($conexion, $nombre_usuario);

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../../public/csspro/administrador.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div id="header-menu">
            <a href="#" class="header-menu-item" id="perfil-btn" title="Perfil de usuario">
                <i class="fas fa-user"></i>
                <span>Perfil de usuario</span>
            </a>
            <a href="#" class="header-menu-item" title="Ayuda">
                <i class="fas fa-question-circle"></i>
                <span>Ayuda</span>
            </a>
            <a href="#" class="header-menu-item" title="Notificaciones">
                <i class="fas fa-bell"></i>
                <span>Notificaciones</span>
            </a>
            <a href="#" class="header-menu-item" id="logout-btn" title="Cerrar sesión">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar sesión</span>
            </a>
        </div>
    </header>
    <main>
        <div class="menu-container">
            <!-- Aquí puedes agregar elementos del menú -->
            <div class="menu-container">
                <a href="../../views/entidades/IndexUsuario.php" class="menu-button"><i class="fas fa-users"></i> Usuarios</a>
                <a href="../../views/entidades/geolocalizacion.php" class="menu-button"><i class="fas fa-globe"></i> Geolocalización</a>
                <a href="../../views/entidades/temperatura.php" class="menu-button"><i class="fas fa-thermometer-three-quarters"></i> Temperatura</a>
                <a href="../../views/entidades/produccionlechera.php" class="menu-button"><i class="fas fa-flask"></i> Producción Lechera</a>
                <a href="../../views/entidades/bovino.php" class="menu-button"><i class="fas fa-cow"></i> Bovino</a>
                <a href="#" class="menu-button"><i class="fas fa-heartbeat"></i> Frecuencia Cardiaca</a>
                <a href="#" class="menu-button"><i class="fas fa-tags"></i> Raza</a>
            </div>
        </div>
    </main>
    <footer>
        <p>Todos los derechos reservados ® AgroConectaWeb 2024</p>
    </footer>

    <!-- Ventana modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <div class="perfil-info" id="perfil-info">
                <?php if(isset($usuario) && $usuario !== null): ?>
                    <img src="<?php echo $usuario['Foto_usuario']; ?>" alt="Foto de perfil">
                    <h3>Nombre: <?php echo $usuario['Nombre']; ?></h3>
                    <h3>Apellido: <?php echo $usuario['Apellido']; ?></h3>
                    <h3>Usuario: <?php echo $usuario['Usuario']; ?></h3>
                <?php else: ?>
                    <p>Error: Usuario no encontrado</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Obtener el modal
        var modal = document.getElementById("modal");

        // Obtener el botón que abre el modal
        var btn = document.getElementById("perfil-btn");

        // Obtener el elemento <span> que cierra el modal
        var span = document.getElementsByClassName("close-button")[0];

        // Cuando el usuario haga clic en el botón, abrir el modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Cuando el usuario haga clic en <span> (x), cerrar el modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Cuando el usuario haga clic fuera del modal, cerrarlo
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
























