<?php
// SeriesController.php

class SeriesController {
    private $serieModel;

    public function __construct() {
        $this->serieModel = new Serie();
    }

    public function addSerie() {
        // Solo el administrador puede añadir series
        if ($_SESSION['user']['role'] === 'admin') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
                $this->serieModel->addSerie($titulo, $descripcion);
                // Redirigir a la lista de series
            }
            include 'app/views/series/add.php';
        } else {
            // Mostrar error: acceso no permitido
        }
    }

    public function index() {
        $series = $this->serieModel->getAllSeries();
        include 'app/views/series/index.php';
    }

    public function rateSerie($id) {
        // Solo los usuarios normales pueden puntuar
        if ($_SESSION['user']['role'] === 'usuario') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $puntuacion = $_POST['puntuacion'];
                $this->serieModel->rateSerie($id, $puntuacion);
                // Redirigir a la lista de series
            }
        } else {
            // Mostrar error: acceso no permitido
        }
    }
}
?>
