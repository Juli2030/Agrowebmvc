<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../../config/config.php';

    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    $stmt = $conexion->prepare("SELECT Id_usuario, Usuario, `Contraseña` FROM Usuario WHERE Usuario = ?");
    $stmt->bindParam(1, $usuario);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        if ($contrasena == $resultado['Contraseña']) {
            $_SESSION['usuario_id'] = $resultado['Id_usuario'];
            header("Location: ../main.php");
            exit;
        } else {
            $_SESSION['mensaje_error'] = "Usuario o contraseña incorrectos";
        }
    } else {
        $_SESSION['mensaje_error'] = "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../../public/csspro/login.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <input type="submit" value="Iniciar Sesión">
    </form>

    <?php
    if (isset($_SESSION['mensaje_error'])) {
        echo "<script>alert('" . $_SESSION['mensaje_error'] . "')</script>";
        unset($_SESSION['mensaje_error']);
    }
    ?>
</body>
</html>







