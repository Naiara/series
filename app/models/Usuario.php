<?php
// Usuario.php
require_once '../app/services/Database.php';

class Usuario {
    private $id;
    private $username;
    private $password;
    private $role;

    private $pdo;

    public function __construct($username, $password, $role = 'usuario') {
        $this->pdo = Database::getConnection();
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Almacenar la contraseña como un hash
        $this->role = $role;
    }
    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRole() {
        return $this->role;
    }
    
    // Método para validar contraseña
    public function verificarPassword($password) {
        return password_verify($password, $this->password);
    }

    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register() {        
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (username, password, role) VALUES (:username, :password, :role)");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);

        return $stmt->execute();
    }    

    // Método para obtener un usuario por su nombre de usuario
    public static function obtenerPorNombre($username) {
        $stmt = Database::getConnection()->prepare("SELECT * FROM usuarios WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene un usuario por su ID
     */
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene todos los usuarios
     */
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cambia la información de un usuario
     */
    public function updateUser($id, $username, $password, $role) {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET username = :username, password = :password, role = :role WHERE id = :id");
        return $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role, 'id' => $id]);
    }

    /**
     * Elimina un usuario por su ID
     */
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
