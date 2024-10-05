<?php
require_once 'app/models/Producto.php'; // Incluir el modelo de Producto

class ProductosController {
    private $pdo;   
    private $productoModel;

    public function __construct() {
        // Inicializa el modelo de Producto
        $this->productoModel = new Producto();  
    }

    // Método para listar todos los productos
    public function index() {
        $productos = $this->productoModel->getAll(); // Obtener datos del modelo
        include 'app/views/productos/index.php'; // Pasar los datos a la vista
    }

    // Método para crear un nuevo producto
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $this->productoModel->create(['nombre' => $nombre, 'precio' => $precio]);
            header('Location: /productos'); // Redirigir después de crear
        } else {
            include 'app/views/productos/create.php'; // Mostrar el formulario de creación
        }
    }

    // Método para actualizar un producto
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $this->productoModel->update($id, ['nombre' => $nombre, 'precio' => $precio]);
            header('Location: /productos'); // Redirigir después de actualizar
        } else {
            $producto = $this->productoModel->getById($id); // Obtener producto por su ID
            include 'app/views/productos/edit.php'; // Mostrar el formulario de edición
        }
    }

    // Método para eliminar un producto
    public function delete($id) {
        $this->productoModel->delete($id); // Llamar al modelo para borrar
        header('Location: /productos'); // Redirigir después de eliminar
    }
}
?>
