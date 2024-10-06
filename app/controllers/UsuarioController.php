<?php
// UsuariosController.php
require_once '../app/controllers/Controller.php';
require_once '../app/models/Usuario.php';
require_once '../app/services/Logger.php';

class UsuarioController extends Controller{

    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login() {
        // Aquí procesarías el login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $user = Usuario::login($username);
            if ($user) {
                //Comporbar si la contraseña es correcta
                if (!password_verify($password, $user->password)) {
                    $error = 'Contraseña incorrecta';
                    include '../app/views/user/login.php';
                    exit();
                }
                //id, name, username, email, role
                //$usuario = new Usuario($user->id, $user->name, $user->username, $user->email, $user->role);
                
                $_SESSION['user'] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role
                ];  // Guardamos la sesión del usuario
                //$_SESSION['role'] = $usuario['role']; // 'admin' o 'usuario'

                // Redirigir a la página principal
                header('Location: index.php?controller=usuario&action=perfil');//controller=usuarios&action=index
            } else {
                // Mostrar error de login
                $error = 'Usuario incorrectos';
                
            }
            exit();
        }
        include '../app/views/user/login.php';
    }

    public function register() {
        // Aquí procesarías el registro
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $role = 'usuario';  // O 'admin' según corresponda
            $usuario = new Usuario(0, $name, $username, $email, $role);
            $usuario->register($password);
            // Redirigir a la página de login
            header('Location: /login');

        }
        include 'app/views/register.php';
    }

    /**
     * Mostrar la lista de usuarios
     */
    public function index() {
        $usuarios = $this->usuarioModel->getAllUsers();
        include 'app/views/user/index.php';
    }

    /**
     * Mostrar el perfil del usuario
     */
    public function perfil() {
        $usuario = $_SESSION['user'];
        include '../app/views/user/perfil.php';
    }

    /**
     * Cerrar la sesión del usuario
     */
    public function logout() {
        $_SESSION = array();

        // Finalmente, destruir la sesión
        session_destroy();
        header('Location: index.php?controller=usuario&action=login');
        exit();
    }
}
?>
