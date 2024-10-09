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
     * Editar una serie
     */
    public function update() {
        // Solo el administrador puede añadir series
        if ($_SESSION['user']['role'] === 'admin') {
            //Admin puede editar cualquier usuario
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $role = $_POST['role'];
                $return = $this->usuarioModel->updateUser($id, $name, $username, $email, $role);
                // Redirigir a la lista de series
                if ($return) {
                    header('Location: index.php?controller=usuario&action=index');
                }
                else $error = 'No se ha podido añadir la serie';
            }else{
                $id = $_GET['id'];
                $usuarioDB = $this->usuarioModel->getUserById($id);
                $usuario = new Usuario($id, $usuarioDB['name'], $usuarioDB['username'], $usuarioDB['email'], $usuarioDB['role']);
                var_dump($usuario);
                include '../app/views/user/update.php';
            }
        }elseif ($_SESSION['user']['id'] == $_POST['id']) {
            //Usuario puede editar su perfil
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_SESSION['user']['id'];
                $name = $_POST['name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $role = $_SESSION['user']['role'];

                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['email'] = $email;

                $return = $this->usuarioModel->updateUser($id, $name, $username, $email, $role);
                // Redirigir a la lista de series
                if ($return) {
                    header('Location: index.php?controller=usuario&action=perfil');
                }
                else $error = 'No se ha podido añadir la serie';
            }else{
                $id = $_SESSION['user']['id'];
                $usuarioDB = $this->usuarioModel->getUserById($id);
                $usuario = new Usuario($id, $usuarioDB['name'], $usuarioDB['username'], $usuarioDB['email'], $usuarioDB['role']);
                var_dump($usuario);
                include '../app/views/user/update.php';
            }
        }else {
            // Mostrar error: acceso no permitido
        }
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
