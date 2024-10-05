<?php

// Inicia la sesión
session_start();

require_once '../config/config.php'; // Archivo de configuración de base de datos
require_once 'routes.php'; // Archivo para definir las rutas

Routing::execute();
// Maneja la lógica de enrutamiento
