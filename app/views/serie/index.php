<?php include_once '../app/views/general/header.php';?>
<h1>Series</h1>
<table class="table">
    <tr>
        <th>Título</th>
        <!-- <th>Description</th> -->
        <th>ISAN</th>
        <th>Estreno</th>
        <th>puntuación media</th>
    </tr>
<?php 
foreach ($series as $serie): ?>
            
        <tr>
            <td title="<?= $serie->getDescripcion(); ?>"><?php echo $serie->getTitulo(); ?></td>
            <!-- <td><?php echo $serie->getDescripcion(); ?></td> -->
            <td><?= $serie->getISAN() ?></td>
            <td><?= $serie->getEstreno() ?></td>
            <td><?php 
                $puntuacion = $serie->getPuntuacionMedia();
                for ($i = 1; $i <= floor($puntuacion); $i++) {?>
                    <img class="estrella" data-id="<?= $i ?>" src="/img/star.png" alt="star" width="20" height="20">
                <?php }
            ?></td>
        </tr>
       
<?php endforeach; ?>
</table>

<?php include_once '../app/views/general/footer.php';?>
