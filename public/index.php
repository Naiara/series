<?php

// Inicia la sesión
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php'; // Archivo de configuración de base de datos
require_once 'routes.php'; // Archivo para definir las rutas
require_once '../app/services/Logger.php'; // Archivo para el servicio de registro

Routing::execute();
// Maneja la lógica de enrutamiento
