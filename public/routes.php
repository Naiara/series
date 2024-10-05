<?php

class Routing {
    private static $controller;
    private static $action;

    /**
     * Controlar la sesión del usuario
     */
    public static function checkSession() {
        session_start();
        if (!isset($_SESSION['user'])) {
            // Redirigir a la página de inicio de sesión si la sesión no está configurada
            header('Location: /index.php?controller=UsuarioController&action=login');
            exit();
        }
    }

    /**
     * Método para ejecutar la acción del controlador
     */
    public static function execute() {
        self::checkSession();
        // Obtener el controlador y la acción de las variables GET
        self::$controller = isset($_GET['controller']) ? $_GET['controller'] : 'UsuarioController';
        self::$action = isset($_GET['action']) ? $_GET['action'] : 'login';
        echo self::$controller;
        echo self::$action;

        // Asegúrate de que el controlador existe
        $controllerFile = '../app/controllers/' . self::$controller . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            // Verifica si la clase del controlador existe
            if (class_exists(self::$controller)) {
                // Crear una instancia del controlador
                $controller = new self::$controller();

                // Verificar que la acción existe en el controlador
                if (method_exists($controller, self::$action)) {
                    // Llama a la acción
                    $controller->{self::$action}();
                } else {
                    // Si la acción no existe, cargar la página 404
                    http_response_code(404);
                    include '../app/views/404.php';
                }
            } else {
                // Clase del controlador no encontrada
                http_response_code(404);
                include '../app/views/405.php';
            }
        } else {
            // Archivo del controlador no encontrado
            http_response_code(404);
            include '../app/views/404.php';
        }
    }
}
