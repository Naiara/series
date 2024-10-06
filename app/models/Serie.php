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
    public function rateSerie($id, $puntuacion) {
        $stmt = Database::getConnection()->prepare("INSERT INTO valoraciones (serie_id, puntuacion) VALUES (:serie_id, :puntuacion)");
        return $stmt->execute(['serie_id' => $id, 'puntuacion' => $puntuacion]);
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
        return $stmt->fetchOne(PDO::FETCH_ASSOC);
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
