<?php
session_start();

// Incluir el archivo de configuración de la base de datos
require_once '../../config/config.php';

// Función para procesar el formulario de registro
function processRegistrationForm() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $documento = $_POST["documento"];
        $correo = $_POST["correo"];
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];
        $tipo_usuario = $_POST["tipo_usuario"];
        $foto_usuario = $_FILES["foto_usuario"]["name"]; // Nombre del archivo de la foto de usuario

        global $conexion;

        if ($conexion) {
            try {
                // Subir foto de usuario al servidor (ajusta la ruta según tu estructura de archivos)
                $target_dir = "../../public/uploads/"; // Directorio donde se almacenarán las fotos
                $target_file = $target_dir . basename($_FILES["foto_usuario"]["name"]);
                move_uploaded_file($_FILES["foto_usuario"]["tmp_name"], $target_file);

                // Insertar datos en la tabla de usuarios
                $stmt = $conexion->prepare("INSERT INTO usuario (nombre, apellido, No_documento, correo, usuario, contrasena, Foto_usuario, Id_tipo_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$nombres, $apellidos, $documento, $correo, $usuario, $contrasena, $foto_usuario, $tipo_usuario]);

                // Guardar mensaje de éxito en sesión
                $_SESSION['success_message'] = "¡Registro exitoso!";

                // Redirigir al usuario a la página correspondiente
                if ($tipo_usuario == 1) {
                    header("Location: ../../views/administrador/administrador.php");
                } elseif ($tipo_usuario == 2) {
                    header("Location: ../../views/empleado/empleador.php");
                }
                exit();
            } catch (Exception $e) {
                echo "<script>alert('Error al registrar usuario: " . $e->getMessage() . "');</script>";
            }
        }
    }
}

// Llamar a la función para procesar el formulario de registro
processRegistrationForm();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroConectaWeb</title>
    <link rel="stylesheet" href="../../public/csspro/registro2.css">
</head>
<body>
    <header>
        Agro Conecta Web
    </header>
    <main>
        <div class="login-form">
            <h2>Registro de usuario</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" required>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>
                <label for="documento">Número de documento:</label>
                <input type="text" id="documento" name="documento" required>
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" required>
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
                <div class="password-field">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                    <span class="toggle-password" id="toggle-password">&#x1F441;</span>
                </div>
                <!-- Línea para mostrar la calidad de la contraseña -->
                <div id="password-message" style="margin-top: 5px;"></div>
                <label for="tipo_usuario">Tipo de usuario:</label>
                <select id="tipo_usuario" name="tipo_usuario" required>
                    <option value="1">Administrador</option>
                    <option value="2">Empleado</option>
                </select>
                <label for="foto_usuario">Foto de usuario:</label>
                <input type="file" id="foto_usuario" name="foto_usuario" accept="image/*" required>
                <button type="submit" name="submit">Registrarse</button>
            </form>
        </div>
    </main>
    <footer>
        <p>Todos los derechos reservados ® AgroConectaWeb 2024</p>
    </footer>
    <?php
    // Mostrar mensaje de éxito si existe
    if (isset($_SESSION['success_message'])) {
        echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
        unset($_SESSION['success_message']); // Eliminar el mensaje de éxito de la sesión
    }
    ?>
    <!-- JavaScript -->
    <script>
        document.getElementById("toggle-password").addEventListener("click", function() {
            var passwordField = document.getElementById("contrasena");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        });

        // Función para verificar la calidad de la contraseña
        document.getElementById("contrasena").addEventListener("input", function() {
            var password = this.value;
            var messageElement = document.getElementById("password-message");

            // Verificar la calidad de la contraseña y asignar una clase de estilo
            if (password.length < 8) {
                messageElement.textContent = "Calidad de la contraseña: Baja";
                messageElement.className = "low-quality";
            } else if (password.length < 12) {
                messageElement.textContent = "Calidad de la contraseña: Media";
                messageElement.className = "medium-quality";
            } else {
                messageElement.textContent = "Calidad de la contraseña: Alta";
                messageElement.className = "high-quality";
            }
        });
    </script>
</body>
</html>















