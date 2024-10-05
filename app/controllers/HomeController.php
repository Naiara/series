<?php
class HomeController {
    public function index() {
        //controlar la lógica de la página de inicio
        //Mirar si el usuario está logueado
        if (isset($_SESSION['user_id'])) {
            // El usuario está logueado, mostrar una página personalizada

            // Aquí se puede agregar más lógica para el panel de control
            
            include 'app/views/dashboard/user.php'; // Cargar la vista de administrador
        } else {
            // El usuario no está logueado, mostrar la página de inicio
            include 'app/views/home.php'; // Cargar la vista
        }
    }
}
?>
