<?php
// Usuario.php
require_once '../app/services/Database.php';

class Usuario {
    private $id;
    private $name;
    private $username;
    private $email;
    private $role;

    public function __construct($id = 0, $name = '', $username = '', $email = "", $role = 'usuario') {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
    }
    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }
    
    // Método para validar contraseña
    public function verificarPassword($password) {
        return password_verify($password, $this->password);
    }

    public static function login($username) {
        $stmt = Database::getConnection()->prepare("SELECT id, name, username, password, email, role FROM usuarios WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
                
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function register($password) {        
        $stmt = Database::getConnection()->prepare("INSERT INTO usuarios (name, username, email, password, role) VALUES (:name, :username, :email, :password, :role)");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $password);
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
        $stmt = Database::getConnection()->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene todos los usuarios
     */
    public function getAllUsers() {
        $stmt = Database::getConnection()->query("SELECT * FROM usuarios order by name, email, username");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cambia la información de un usuario
     */
    public function updateUser($id, $username, $password, $role) {
        $stmt = Database::getConnection()->prepare("UPDATE usuarios SET username = :username, password = :password, role = :role WHERE id = :id");
        return $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role, 'id' => $id]);
    }

    /**
     * Elimina un usuario por su ID
     */
    public function deleteUser($id) {
        $stmt = Database::getConnection()->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
