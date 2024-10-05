<?php
// UsuariosController.php
require_once '../app/controllers/Controller.php';
require_once '../app/models/Usuario.php';

class UsuarioController extends Controller{//
    private $usuarioModel;

    public function login() {
        // Aquí procesarías el login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $user = $this->usuarioModel->login($username, $hashed_password);

            if ($user) {
                $_SESSION['user'] = $user;  // Guardamos la sesión del usuario
                //$_SESSION['role'] = $usuario['role']; // 'admin' o 'usuario'

                // Redirigir a la página principal
                header('Location: /');//controller=usuarios&action=index
            } else {
                // Mostrar error de login
                $error = 'Usuario o contraseña incorrectos';
                
            }
        }
        include '../app/views/user/login.php';
    }

    public function register() {
        // Aquí procesarías el registro
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = 'usuario';  // O 'admin' según corresponda
            $this->usuarioModel->register($username, $password, $role);
            // Redirigir a la página de login
            header('Location: /login');

        }
        include 'app/views/register.php';
    }

    public function index() {
        $usuarios = $this->usuarioModel->getAllUsers();
        include 'app/views/usuarios/index.php';
    }
}
?>
