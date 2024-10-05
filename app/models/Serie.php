<?php
// Serie.php
require_once 'app/services/Database.php';

class Serie {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * Añade una nueva serie a la base de datos
     */
    public function addSerie($titulo, $descripcion) {
        $stmt = $this->pdo->prepare("INSERT INTO series (titulo, descripcion) VALUES (:titulo, :descripcion)");
        return $stmt->execute(['titulo' => $titulo, 'descripcion' => $descripcion]);
    }

    /**
     * Obtiene una serie por su ID
     */
    public function getSerieById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM series WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene todas las series
     */
    public function getAllSeries() {
        $stmt = $this->pdo->query("SELECT * FROM series");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Actualiza la información de una serie
     */
    public function rateSerie($id, $puntuacion) {
        $stmt = $this->pdo->prepare("INSERT INTO valoraciones (serie_id, puntuacion) VALUES (:serie_id, :puntuacion)");
        return $stmt->execute(['serie_id' => $id, 'puntuacion' => $puntuacion]);
    }

    /**
     * Elimina una serie por su ID
     */
    public function deleteSerie($id) {
        $stmt = $this->pdo->prepare("DELETE FROM series WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Obtiene la puntuación media de una serie
     */
    public function getAverageRating($id) {
        $stmt = $this->pdo->prepare("SELECT AVG(puntuacion) AS puntuacion_media FROM valoraciones WHERE serie_id = :serie_id");
        $stmt->execute(['serie_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene las valoraciones de una serie
     */
    public function getRatings($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM valoraciones WHERE serie_id = :serie_id");
        $stmt->execute(['serie_id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene las series con una puntuación mayor o igual a la indicada
     */
    public function getSeriesByRating($puntuacion) {
        $stmt = $this->pdo->prepare("SELECT * FROM series WHERE id IN (SELECT serie_id FROM valoraciones WHERE puntuacion >= :puntuacion)");
        $stmt->execute(['puntuacion' => $puntuacion]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
