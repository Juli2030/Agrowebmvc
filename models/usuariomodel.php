<?php
// Incluir la clase base del modelo
require_once '../../libs/model.php';

class UsuarioModel extends Model {
    // Método para obtener todos los usuarios
    public function obtenerUsuarios() {
        // Consulta SQL para seleccionar todos los registros de la tabla Usuario
        $query = "SELECT Id_usuario, Nombre, Apellido, No_documento, Usuario, correo, Id_tipo_usuario FROM Usuario";

        // Preparar la consulta
        $statement = $this->db->prepare($query);

        // Ejecutar la consulta
        $statement->execute();

        // Devolver todos los resultados como un arreglo asociativo
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener los tipos de usuario válidos
    public function obtenerTiposUsuario() {
        // Consulta SQL para seleccionar todos los registros de la tabla tipo_usuario
        $query = "SELECT Id_tipo_usuario FROM tipo_usuario";

        // Preparar la consulta
        $statement = $this->db->prepare($query);

        // Ejecutar la consulta
        $statement->execute();

        // Devolver todos los resultados como un arreglo asociativo
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para agregar un nuevo usuario
    public function agregarUsuario($datosUsuario) {
        // Consulta SQL para insertar un nuevo registro en la tabla Usuario
        $query = "INSERT INTO Usuario (Nombre, Apellido, No_documento, Usuario, correo, Id_tipo_usuario) VALUES (:Nombre, :Apellido, :No_documento, :Usuario, :correo, :Id_tipo_usuario)";

        // Preparar la consulta
        $statement = $this->db->prepare($query);

        // Ejecutar la consulta con los datos del usuario
        return $statement->execute($datosUsuario);
    }

    // Método para actualizar un usuario
    public function actualizarUsuario($id, $datosUsuario) {
        // Obtener los tipos de usuario válidos
        $tiposUsuarioValidos = $this->obtenerTiposUsuario();
        $tiposValidos = array_column($tiposUsuarioValidos, 'Id_tipo_usuario');

        // Verificar que el Id_tipo_usuario ingresado sea válido
        if (!in_array($datosUsuario['Id_tipo_usuario'], $tiposValidos)) {
            // El Id_tipo_usuario no es válido, no se puede actualizar el usuario
            return false;
        }

        // Consulta SQL para actualizar un registro en la tabla Usuario por su ID
        $query = "UPDATE Usuario SET Nombre = :Nombre, Apellido = :Apellido, No_documento = :No_documento, Usuario = :Usuario, correo = :correo, Id_tipo_usuario = :Id_tipo_usuario WHERE Id_usuario = :id";

        // Preparar la consulta
        $statement = $this->db->prepare($query);

        // Vincular los valores de los parámetros
        $statement->bindParam(':Nombre', $datosUsuario['Nombre']);
        $statement->bindParam(':Apellido', $datosUsuario['Apellido']);
        $statement->bindParam(':No_documento', $datosUsuario['No_documento']);
        $statement->bindParam(':Usuario', $datosUsuario['Usuario']);
        $statement->bindParam(':correo', $datosUsuario['correo']);
        $statement->bindParam(':Id_tipo_usuario', $datosUsuario['Id_tipo_usuario']);
        $statement->bindParam(':id', $id);

        // Ejecutar la consulta con los datos actualizados del usuario
        return $statement->execute();
    }

    // Método para eliminar un usuario
    public function eliminarUsuario($id) {
        // Consulta SQL para eliminar un registro de la tabla Usuario por su ID
        $query = "DELETE FROM Usuario WHERE Id_usuario = :id";

        // Preparar la consulta
        $statement = $this->db->prepare($query);

        // Asignar el valor del parámetro :id
        $statement->bindParam(':id', $id);

        // Ejecutar la consulta
        return $statement->execute();
    }
}
?>

