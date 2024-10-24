<?php
require_once '../app/models/Serie.php';
require_once '../app/services/Logger.php';
require_once '../app/controllers/Controller.php';

class SerieController {
    private $serieModel;

    public function __construct() {
        $this->serieModel = new Serie();
    }

    /**
     * Añadir una nueva serie
     */
    public function add() {
        // Solo el administrador puede añadir series
        if ($_SESSION['user']['role'] === 'admin') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
                $isan = $_POST['isan'];
                $estreno = $_POST['estreno'];
                
                if ($this->validarAnioEstreno($estreno) && $this->validarISAN($isan)) {
                    $return = $this->serieModel->addSerie($titulo, $isan, $descripcion, $estreno);
                    // Redirigir a la lista de series
                    if ($return) {
                        header('Location: index.php?controller=serie&action=gestion');
                    }
                    else $error = 'No se ha podido añadir la serie';
                } else {
                    $error = 'El año de estreno o el ISAN no son válidos';
                }
                /* $return = $this->serieModel->addSerie($titulo, $isan, $descripcion, $estreno);
                // Redirigir a la lista de series
                if ($return) {
                    header('Location: index.php?controller=serie&action=gestion');
                }
                else $error = 'No se ha podido añadir la serie'; */
            }
            include '../app/views/serie/add.php';
        } else {
            // Mostrar error: acceso no permitido
        }
    }

    /**
     * Editar una serie
     */
    public function update() {
        // Solo el administrador puede añadir series
        if ($_SESSION['user']['role'] === 'admin') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
                $isan = $_POST['isan'];
                $estreno = $_POST['estreno'];
                if ($this->validarAnioEstreno($estreno) && $this->validarISAN($isan)) {
                    $return = $this->serieModel->updateSerie($id, $titulo, $isan, $descripcion, $estreno);
                    // Redirigir a la lista de series
                    if ($return) {
                        header('Location: index.php?controller=serie&action=gestion');
                    }
                    else $error = 'No se ha podido añadir la serie';
                } else {
                    $error = 'El año de estreno o el ISAN no son válidos';
                }
                /* $return = $this->serieModel->updateSerie($id, $titulo, $isan, $descripcion, $estreno);
                // Redirigir a la lista de series
                if ($return) {
                    header('Location: index.php?controller=serie&action=gestion');
                }
                else $error = 'No se ha podido añadir la serie'; */
            }else{
                $id = $_GET['id'];
                $serieDB = $this->serieModel->getSerieById($id);
                $serie = new Serie($id, $serieDB['titulo'], $serieDB['ISAN'], $serieDB['descripcion'],  $serieDB['estreno']);

                //include '../app/views/serie/update.php';
            }
        } else {
            $error = 'Acceso no permitido';
        }
        
        include '../app/views/serie/update.php';
    }

    /**
     * Lista de todas las series ordenada por puntuación
     */
    public function index() {
        $seriesBD = $this->serieModel->getAllSeries();
        $series = [];

        //Hay que mostrar la puntuación media de cada serie
        foreach ($seriesBD as $serieBD) {
            $serie = new Serie($serieBD['id'], $serieBD['titulo'], $serieBD['ISAN'], $serieBD['descripcion'], $serieBD['estreno']);            
            $serie->setPuntuacionMedia((float)$serie->getAverageRating());
            $series[] = $serie;
        }

        //Ordenar las series de mayor a menor puntuación
        usort($series, function($a, $b) {
            if ($a->getPuntuacionMedia() == $b->getPuntuacionMedia()) {
                return 0;
            }
            return ($a->getPuntuacionMedia() > $b->getPuntuacionMedia()) ? -1 : 1;
        });

        include '../app/views/serie/index.php';
    }

    /**
     * Lista para publicar las series y editarlas
     */
    public function gestion() {
        $seriesBD = $this->serieModel->getAllSeries();
        $series = [];

        //Hay que mostrar la puntuación media de cada serie
        foreach ($seriesBD as $serieBD) {
            //id, titulo, descripcion, ISAN, estreno
            $serie = new Serie($serieBD['id'], $serieBD['titulo'], $serieBD['ISAN'], $serieBD['descripcion'], $serieBD['estreno']);   
            $series[] = $serie;
        }

        include '../app/views/serie/indexAdmin.php';
    }



    /**
     * Series con puntuación del usuario concreto
     */
    public function puntuar() {
        //$seriesBD = $this->serieModel->getAllSeries();
        $seriesBD = $this->serieModel->getAllSeriesByUser($_SESSION['user']['id']);
        $series = [];

        //Hay que mostrar la puntuación media de cada serie
        foreach ($seriesBD as $serieBD) {
            $serie = new Serie($serieBD['id'], $serieBD['titulo'], $serieBD['ISAN'], $serieBD['descripcion'], $serieBD['estreno']);            
            $serie->setPuntuacionMedia($serieBD['puntuacion']);
            $series[] = $serie;
        }

        include '../app/views/serie/indexUsuario.php';
    }

    /**
     * Puntuar una serie
     */
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

    /**
     * Funcionalidad para borrar un serie
     */
    public function delete() {
        if ($_SESSION['user']['role'] === 'admin') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'];
                
                $resultado = $this->serieModel->deleteSerie($id);
                $resultado = true;
                if ($resultado) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se ha ejecutado correctamente la consulta']);
                } 
            }else{
                echo json_encode(['success' => false, 'message' => 'No hay envío con post']);
            }
        } else {
            // Mostrar error: acceso no permitido
                    echo json_encode(['success' => false, 'message' => 'No tienes permisos suficientes']);
        }
    }

    
    
    // Función para validar el año de estreno
    function validarAnioEstreno($anio) {
        $anioActual = date("Y"); // Obtiene el año actual
        // Verifica que el año es un número entre 1800 y el año actual
        if (is_numeric($anio) && $anio >= 1800 && $anio <= $anioActual) {
            return true;
        }
        return false;
    }

    // Función para validar el ISAN (8 dígitos)
    function validarISAN($isan) {
        // Verifica que el ISAN sea un número de 8 dígitos
        if (preg_match('/^\d{8}$/', $isan)) {
            return true;
        }
        return false;
    }
}
?>
