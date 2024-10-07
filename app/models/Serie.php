<?php
// Serie.php
require_once '../app/services/Database.php';

class Serie {

    private $id;
    private $titulo;
    private $descripcion;
    private $puntuacion_media;

    public function __construct($id = 0, $titulo = "", $descripcion = "", $pt = 0) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->puntuacion_media = $pt;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPuntuacionMedia() {
        return $this->puntuacion_media;
    }

    public function setPuntuacionMedia($pt) {
        $this->puntuacion_media = $pt;
    }

    public function getPuntuacionUsuario() {
        $stmt = Database::getConnection()->prepare("SELECT puntuacion FROM valoraciones WHERE usuario_id = :usuario_id AND serie_id = :serie_id");
        $stmt->bindParam(':usuario_id', $_SESSION['user']['id']);
        $stmt->bindParam(':serie_id', $this->id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Añade una nueva serie a la base de datos
     */
    public function addSerie($titulo, $descripcion) {
        $stmt = Database::getConnection()->prepare("INSERT INTO series (titulo, descripcion) VALUES (:titulo, :descripcion)");
        return $stmt->execute(['titulo' => $titulo, 'descripcion' => $descripcion]);
    }

    /**
     * Obtiene una serie por su ID
     */
    public function getSerieById($id) {
        $stmt = Database::getConnection()->prepare("SELECT * FROM series WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene todas las series
     */
    public function getAllSeries() {
        $stmt = Database::getConnection()->query("SELECT id, titulo, descripcion FROM series");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Actualiza la información de una serie
     */
    public function rateSerie($id_serie, $id_usuario, $puntuacion) {
        //Comprobar si la serie ya ha sido puntuada por ese usuario
        $stmt = Database::getConnection()->prepare("SELECT * FROM valoraciones WHERE usuario_id = :usuario_id AND serie_id = :serie_id");   
        $stmt->bindParam(':usuario_id', $id_usuario);
        $stmt->bindParam(':serie_id', $id_serie);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            //Actualizar la puntuación
            $stmt = Database::getConnection()->prepare("UPDATE valoraciones SET puntuacion = :puntuacion WHERE usuario_id = :usuario_id AND serie_id = :serie_id");
        }else{
            //Insertar puntuación
            $stmt = Database::getConnection()->prepare("INSERT INTO valoraciones (usuario_id, serie_id, puntuacion) VALUES (:usuario_id, :serie_id, :puntuacion)");
        }

        $stmt->bindParam(':usuario_id', $id_usuario);
        $stmt->bindParam(':serie_id', $id_serie);
        $stmt->bindParam(':puntuacion', $puntuacion);
        return $stmt->execute();
    }

    /**
     * Elimina una serie por su ID
     */
    public function deleteSerie($id) {
        $stmt = Database::getConnection()->prepare("DELETE FROM series WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Obtiene la puntuación media de una serie
     */
    public function getAverageRating() {
        $stmt = Database::getConnection()->prepare("SELECT AVG(puntuacion) AS puntuacion_media FROM valoraciones WHERE serie_id = :serie_id");
        $stmt->execute(['serie_id' => $this->id]);
        return $stmt->fetchColumn();
    }

    /**
     * Obtiene las valoraciones de una serie
     */
    public function getRatings($id) {
        $stmt = Database::getConnection()->prepare("SELECT * FROM valoraciones WHERE serie_id = :serie_id");
        $stmt->execute(['serie_id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene las series con una puntuación mayor o igual a la indicada
     */
    public function getSeriesByRating($puntuacion) {
        $stmt = Database::getConnection()->prepare("SELECT * FROM series WHERE id IN (SELECT serie_id FROM valoraciones WHERE puntuacion >= :puntuacion)");
        $stmt->execute(['puntuacion' => $puntuacion]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
