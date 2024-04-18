<?php
require_once "../../models/usuariomodel.php";

// Instanciar el modelo de usuario
$usuarioModel = new UsuarioModel();

// Verificar si se envió el formulario de eliminar
if(isset($_POST['eliminar'])){
    $idUsuario = $_POST['id_usuario'];
    // Llamar al método del modelo para eliminar el usuario
    $usuarioModel->eliminarUsuario($idUsuario);
}

// Verificar si se envió el formulario de guardar cambios
if(isset($_POST['guardar'])){
    $idUsuario = $_POST['id_usuario'];
    $datosUsuario = array(
        'Id_usuario' => $idUsuario,
        'Nombre' => isset($_POST['Nombre']) ? $_POST['Nombre'] : '',
        'Apellido' => isset($_POST['Apellido']) ? $_POST['Apellido'] : '',
        'No_documento' => isset($_POST['No_documento']) ? $_POST['No_documento'] : '',
        'Usuario' => isset($_POST['Usuario']) ? $_POST['Usuario'] : '',
        'correo' => isset($_POST['correo']) ? $_POST['correo'] : '',
        'Id_tipo_usuario' => isset($_POST['Id_tipo_usuario']) ? $_POST['Id_tipo_usuario'] : ''
    );
    // Llamar al método del modelo para actualizar el usuario
    $usuarioModel->actualizarUsuario($idUsuario, $datosUsuario);
}

// Obtener todos los usuarios
$usuarios = $usuarioModel->obtenerUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <link rel="stylesheet" href="../../public/csspro/indexUsuario.css">
</head>
<body>

    <h1>Tabla de Usuarios</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>No. Documento</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>ID Tipo Usuario</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario['Id_usuario']; ?></td>
            <td>
                <?php if(isset($_GET['edit']) && $_GET['edit'] == $usuario['Id_usuario']): ?>
                <input type="text" name="Nombre" value="<?php echo isset($usuario['Nombre']) ? $usuario['Nombre'] : ''; ?>">
                <?php else: ?>
                <?php echo isset($usuario['Nombre']) ? $usuario['Nombre'] : ''; ?>
                <?php endif; ?>
            </td>
            <td>
                <?php if(isset($_GET['edit']) && $_GET['edit'] == $usuario['Id_usuario']): ?>
                <input type="text" name="Apellido" value="<?php echo isset($usuario['Apellido']) ? $usuario['Apellido'] : ''; ?>">
                <?php else: ?>
                <?php echo isset($usuario['Apellido']) ? $usuario['Apellido'] : ''; ?>
                <?php endif; ?>
            </td>
            <td>
                <?php if(isset($_GET['edit']) && $_GET['edit'] == $usuario['Id_usuario']): ?>
                <input type="text" name="No_documento" value="<?php echo isset($usuario['No_documento']) ? $usuario['No_documento'] : ''; ?>">
                <?php else: ?>
                <?php echo isset($usuario['No_documento']) ? $usuario['No_documento'] : ''; ?>
                <?php endif; ?>
            </td>
            <td>
                <?php if(isset($_GET['edit']) && $_GET['edit'] == $usuario['Id_usuario']): ?>
                <input type="text" name="Usuario" value="<?php echo isset($usuario['Usuario']) ? $usuario['Usuario'] : ''; ?>">
                <?php else: ?>
                <?php echo isset($usuario['Usuario']) ? $usuario['Usuario'] : ''; ?>
                <?php endif; ?>
            </td>
            <td>
                <?php if(isset($_GET['edit']) && $_GET['edit'] == $usuario['Id_usuario']): ?>
                <input type="text" name="correo" value="<?php echo isset($usuario['correo']) ? $usuario['correo'] : ''; ?>">
                <?php else: ?>
                <?php echo isset($usuario['correo']) ? $usuario['correo'] : ''; ?>
                <?php endif; ?>
            </td>
            <td>
                <?php if(isset($_GET['edit']) && $_GET['edit'] == $usuario['Id_usuario']): ?>
                <input type="text" name="Id_tipo_usuario" value="<?php echo isset($usuario['Id_tipo_usuario']) ? $usuario['Id_tipo_usuario'] : ''; ?>">
                <?php else: ?>
                <?php echo isset($usuario['Id_tipo_usuario']) ? $usuario['Id_tipo_usuario'] : ''; ?>
                <?php endif; ?>
            </td>
            <td>
                <?php if(isset($_GET['edit']) && $_GET['edit'] == $usuario['Id_usuario']): ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['Id_usuario']; ?>">
                    <button type="submit" name="guardar">Guardar</button>
                </form>
                <?php else: ?>
                <a href="<?php echo $_SERVER['PHP_SELF'] . '?edit=' . $usuario['Id_usuario']; ?>">Editar</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form action="menu.php" method="post">
        <button type="submit" name="regresar">Regresar al Menú</button>
    </form>
    <footer>
        <p>Todos los derechos reservados ® AgroConectaWeb 2024</p>
    </footer>
</body>
</html>