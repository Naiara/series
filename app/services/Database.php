<?php
// Database.php

require_once '../config/config.php';  // Asegúrate de incluir el archivo de configuración

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        // Establece la conexión utilizando los datos de config.php
        $this->pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getConnection() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
?>
