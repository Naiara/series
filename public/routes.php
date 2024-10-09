<?php
require_once '../app/services/Logger.php';

class Routing {
    private static $controller;
    private static $action;

    /**
     * Controlar la sesión del usuario
     */
    public static function checkSession() {
        if (!isset($_SESSION['user'])) {
            // Redirigir a la página de inicio de sesión si la sesión no está configurada
            header('Location: /index.php?controller=usuario&action=login');
            exit();
        }
    }

    /**
     * Método para ejecutar la acción del controlador
     */
    public static function execute() {

        // Obtener el controlador y la acción de las variables GET
        self::$controller = isset($_GET['controller']) ? $_GET['controller'] : 'usuario';
        self::$action = isset($_GET['action']) ? $_GET['action'] : 'perfil';
        //echo self::$controller;
        //echo self::$action;

        if (self::$controller !== 'usuario' || self::$action !== 'login') {
            // Verificar la sesión del usuario
            self::checkSession();
        }

        self::$controller = ucfirst(self::$controller) . 'Controller';

        // Asegúrate de que el controlador existe
        $controllerFile = '../app/controllers/' . self::$controller . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile; 
            // Verifica si la clase del controlador existe
            if (class_exists(self::$controller)) {
                //exit;
                $controllerClass = self::$controller;
                $execController = new $controllerClass();
  
                // Verificar que la acción existe en el controlador
                if (method_exists($execController, self::$action)) {
                    // Llama a la acción
                    $execController->{self::$action}();
                } else {
                    // Si la acción no existe, cargar la página 404
                    http_response_code(404);
                    include '../app/views/404.php';
                }
            } else {
                // Clase del controlador no encontrada
                http_response_code(404);
                include '../app/views/404.php';
            }
        } else {
            // Archivo del controlador no encontrado
            http_response_code(404);
            include '../app/views/404.php';
        }
    }
}
