<?php

    class AuthController {
        public function login() {
            // Lógica para mostrar el formulario de inicio de sesión
            include('../views/auth/login.php');
        }

        public function authenticate() {
            // Verificar si se han enviado las credenciales del formulario
            if(isset($_POST['username']) && isset($_POST['password'])) {
                // Obtener las credenciales del formulario
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Aquí deberías implementar la lógica para verificar las credenciales en la base de datos
                // Por ahora, vamos a simular un usuario de ejemplo con nombre de usuario 'admin' y contraseña 'password'
                if($username === 'admin' && $password === 'password') {
                    // Iniciar sesión
                    session_start();
                    $_SESSION['username'] = $username;
                    
                    // Redirigir al usuario al panel correspondiente
                    header('Location: ../views/main/panel.php');
                    exit();
                } else {
                    // Si las credenciales no son válidas, mostrar un mensaje de error y volver al formulario de inicio de sesión
                    echo "Credenciales incorrectas. Por favor, inténtelo de nuevo.";
                    $this->login();
                }
            } else {
                // Si no se enviaron las credenciales, redirigir al formulario de inicio de sesión
                header('Location: ../views/auth/login.php');
                exit();
            }
        }

        public function logout() {
            // Finalizar la sesión actual, si existe
            session_start();
            session_unset();
            session_destroy();
            
            // Redirigir al usuario a la página de inicio o a la página de inicio de sesión
            header('Location: ../views/main/index.php');
            exit();
        }
    }
?>
