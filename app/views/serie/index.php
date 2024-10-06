<?php include_once '../app/views/general/encabezado.php';?>
<h1>Series</h1>
<?php foreach ($series as $serie): ?>
    <h2><?php echo $serie->getTitulo(); ?></h2>
    <p><?php echo $serie->getDescripcion(); ?></p>
    <p><?php echo $serie->getPuntuacionMedia(); ?></p>
    <!-- <form method="POST" action="index.php?controller=serie&action=update">
        <input type="number" name="puntuacion" min="1" max="5" required>
        <input type="hidden" name="id" value="<?php //echo $serie->getId(); ?>">
        <button type="submit">Puntuar</button>
    </form> -->
    <input type="hidden" name="id" value="<?php echo $serie->getId(); ?>">
    <!-- segun la puntuación que tengas se enseñan numero de estrellas -->
     <img class="star" data-value="1" src="../public/img/star.png" alt="star" width="20" height="20">
     <img class="star" data-value="2" src="../public/img/star.png" alt="star" width="20" height="20">
     <img class="star" data-value="3" src="../public/img/star.png" alt="star" width="20" height="20">
     <img class="star" data-value="4" src="../public/img/star.png" alt="star" width="20" height="20">
     <img class="star" data-value="5" src="../public/img/star.png" alt="star" width="20" height="20">
<?php endforeach; ?>

<?php include_once '../app/views/general/footer.php';?>
