<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    // Si el usuario ya ha iniciado sesión, redirigirlo a la página correspondiente
    if ($_SESSION['tipo_usuario'] == 1) {
        // Administrador
        header("Location: views/administrador/administrador.php");
        exit(); // Salir después de la redirección
    } elseif ($_SESSION['tipo_usuario'] == 2) {
        // Empleado
        header("Location: views/empleado/empleador.php");
        exit(); // Salir después de la redirección
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se hayan enviado los datos de usuario, contraseña y tipo de usuario
    if (!empty($_POST["usuario"]) && !empty($_POST["contraseña"]) && isset($_POST["tipo_usuario"])) {
        // Obtener y limpiar los datos del formulario
        $usuario = trim($_POST["usuario"]);
        $contraseña = trim($_POST["contraseña"]);
        $tipo_usuario = $_POST["tipo_usuario"];

        // Incluir el archivo de configuración de la base de datos
        require_once 'config/config.php';

        // Crear una conexión a la base de datos
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión a la base de datos: " . $conn->connect_error);
        }

        // Consulta SQL para validar las credenciales del usuario en la base de datos
        $sql = "SELECT Id_usuario, contrasena, Usuario FROM usuario WHERE usuario = ? AND Id_tipo_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $usuario, $tipo_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Las credenciales son válidas
            $row = $result->fetch_assoc();
            $stored_password = $row['contrasena'];

            // Verificar la contraseña
            if ($contraseña === $stored_password) {
                // Almacenar el ID, el tipo de usuario y el nombre de usuario en la sesión
                $_SESSION['user_id'] = $row['Id_usuario'];
                $_SESSION['tipo_usuario'] = $tipo_usuario;
                $_SESSION['usuario'] = $row['Usuario'];

                // Redirigir al usuario a la página correspondiente
                if ($tipo_usuario == 1) {
                    // Administrador
                    header("Location: views/administrador/administrador.php");
                    exit(); // Salir después de la redirección
                } else {
                    // Empleado
                    header("Location: views/empleado/empleador.php");
                    exit(); // Salir después de la redirección
                }
            } else {
                // Contraseña incorrecta
                $error_message = "Inicio de sesión fallido. La contraseña proporcionada no coincide.";
            }
        } else {
            // Usuario no encontrado
            $error_message = "Inicio de sesión fallido. Por favor, verifique sus credenciales.";
        }

        // Cerrar la conexión a la base de datos
        $stmt->close();
        $conn->close();
    } else {
        // Si no se enviaron todos los datos esperados, muestra un mensaje de error
        $error_message = "Por favor, complete todos los campos del formulario.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-gdZU+uKkUX0+Y0Z0WzEYZ6yg6gsh+QTrNvDgaPzvTZ0r4LCLYW6+93tq1xZwh1A27Vx+jQ6tH4b5CVqwR+ZjcA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="public/csspro/index.css">
    <title>AgroConectaWeb</title>
</head>
<body>
    <header>
        <h1>AgroConectaWeb</h1>
    </header>
    <main>
        <img src="public/img/imagen1.png" alt="Imagen de ganado">
        <div class="login-form">
            <h2>Iniciar sesión</h2>
            <?php if(isset($error_message)) { ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php } ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <select name="tipo_usuario">
                    <option value="1">Administrador</option>
                    <option value="2">Empleado</option>
                </select>
                <div class="input-with-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="usuario" placeholder="Usuario">
                </div>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="contraseña" id="contrasena" placeholder="Contraseña">
                    <span id="toggle-password" class="fas fa-eye-slash"></span>
                </div>
                <button type="submit">Ingresar</button>
            </form>
            <p>¿No tienes una cuenta? <a href="views/auth/registro2.php">Regístrate aquí</a></p>
        </div>
    </main>
    <footer>
        <p>Todos los derechos reservados ® AgroConectaWeb 2024</p>
    </footer>

    <script>
        document.getElementById("toggle-password").addEventListener("click", function() {
            var passwordField = document.getElementById("contrasena");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
            } else {
                passwordField.type = "password";
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
            }
        });
    </script>
</body>
</html>
























