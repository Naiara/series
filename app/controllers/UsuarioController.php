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
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $email = $_POST['email'];
            $role = $_POST['role'];  // O 'admin' según corresponda
            $usuario = new Usuario(0, $name, $username, $email, $role);
            $usuario->register($hashed_password);
            // Redirigir a la página de login
            header('Location: /index.php?controller=usuario&action=index');

        }
        include '../app/views/user/register.php';
    }

    /**
     * Mostrar la lista de usuarios
     */
    public function index() {
        $usuariosBD = $this->usuarioModel->getAllUsers();
        $usuarios = [];
        //Hay que mostrar la puntuación media de cada serie
        foreach ($usuariosBD as $usuarioBD) {
            $usuario = new Usuario($usuarioBD['id'], $usuarioBD['name'], $usuarioBD['username'], $usuarioBD['email'], $usuarioBD['role']);           
            $usuarios[] = $usuario;
        }
        include '../app/views/user/index.php';
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

    /**
     * Funcionalidad para borrar un usuario
     */
    public function borrar() {
        if ($_SESSION['user']['role'] === 'admin') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'];
                
                $resultado = $this->usuarioModel->deleteUser($id);
                $resultado = true;
                if ($resultado) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se ha ejecutado correctamente la consulta']);
                } 
            }else{
                echo json_encode(['success' => false, 'message' => 'No hay envío con post']);
            }
        } else {
            // Mostrar error: acceso no permitido
                    echo json_encode(['success' => false, 'message' => 'No tienes permisos suficientes']);
        }
    }
}
?>
