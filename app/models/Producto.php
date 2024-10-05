<?php
// Producto.php
require_once 'app/services/Database.php';

class Producto {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();  // Obtén la conexión a la base de datos
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear (C) - Insertar un nuevo producto
    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO productos (nombre, precio) VALUES (:nombre, :precio)");
        return $stmt->execute([':nombre' => $data['nombre'], ':precio' => $data['precio']]);
    }

    // Leer (R) - Obtener todos los productos
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar (U) - Modificar un producto por su ID
    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE productos SET nombre = :nombre, precio = :precio WHERE id = :id");
        return $stmt->execute([':nombre' => $data['nombre'], ':precio' => $data['precio'], ':id' => $id]);
    }

    // Eliminar (D) - Borrar un producto por su ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM productos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
