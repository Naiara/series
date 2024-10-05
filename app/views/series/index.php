<h1>Series</h1>
<?php foreach ($series as $serie): ?>
    <h2><?php echo $serie['titulo']; ?></h2>
    <p><?php echo $serie['descripcion']; ?></p>
    <form method="POST" action="rate.php?id=<?php echo $serie['id']; ?>">
        <input type="number" name="puntuacion" min="1" max="5" required>
        <button type="submit">Puntuar</button>
    </form>
<?php endforeach; ?>
