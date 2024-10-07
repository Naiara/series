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

    /**
     * Series con puntuación del usuario concreto
     */
    public function puntuar() {
        $seriesBD = $this->serieModel->getAllSeries();
        $series = [];

        //Hay que mostrar la puntuación media de cada serie
        foreach ($seriesBD as $serieBD) {
            $serie = new Serie($serieBD['id'], $serieBD['titulo'], $serieBD['descripcion']);            
            //$serie->setPuntuacionMedia($serie->getAverageRating());
            $series[] = $serie;
        }

        include '../app/views/serie/indexUsuario.php';
    }

    public function puntuarSerie(){
        if (isset($_SESSION['user'])) {
            $id_usuario = $_SESSION['user']['id'];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $id_serie = $data['id'];
                $puntuacion = $data['puntuacion'];
                
                $resultado = $this->serieModel->rateSerie($id_serie, $id_usuario, $puntuacion);
                if ($resultado) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se ha ejecutado correctamente la consulta']);
                }
            }
        } else {
            // Mostrar error: acceso no permitido
            echo json_encode(['success' => false, 'message' => 'Sessión no iciciada']);
        }
    }
}
?>
