<?php
require_once '../app/models/Serie.php';
require_once '../app/services/Logger.php';
require_once '../app/controllers/Controller.php';

class SerieController {
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
            include '../app/views/serie/add.php';
        } else {
            // Mostrar error: acceso no permitido
        }
    }

    public function index() {
        $seriesBD = $this->serieModel->getAllSeries();
        $series = [];

        //Hay que mostrar la puntuación media de cada serie
        foreach ($seriesBD as $serieBD) {
            $serie = new Serie($serieBD['id'], $serieBD['titulo'], $serieBD['descripcion']);            
            $serie->setPuntuacionMedia($serie->getAverageRating());
            $series[] = $serie;
        }

        include '../app/views/serie/index.php';
    }

    public function rateSerie($id) {
        // Solo los usuarios normales pueden puntuar
        if ($_SESSION['user']['role'] === 'usuario') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $puntuacion = $_POST['puntuacion'];
                $this->serieModel->rateSerie($id, $puntuacion);
                // Redirigir a la lista de serie
            }
        } else {
            // Mostrar error: acceso no permitido
        }
    }
}
?>
