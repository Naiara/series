<?php include_once '../app/views/general/header.php';?>
<h1>Series</h1>
<table class="table">
<?php foreach ($series as $serie): ?>
            
        <tr>
            <td title="<?= $serie->getDescripcion(); ?>"><?php echo $serie->getTitulo(); ?></td>
           <!--  <td><?php echo $serie->getDescripcion(); ?></td> -->
            <td><?php 
                //echo $serie->getPuntuacionUsuario() . ' - ' . $serie->getPuntuacionMedia();
                $puntuacion = $serie->getPuntuacionMedia();
                if ($puntuacion == null) {
                    $puntuacion = 0;
                }
                for ($i = 1; $i <= floor($puntuacion); $i++) {
                    $id_estrella = 'estrella' . $serie->getId() . '_' . $i;
                    ?>
                    <img id="<?= $id_estrella?>" class="estrella" data-serieid="<?= $serie->getId()?>" data-puntuacion="<?= $i ?>" src="img/star.png" alt="star" width="20" height="20">
                <?php }
                for ($i = floor($puntuacion)+1; $i <=5; $i++) {
                    $id_estrella = 'estrella' . $serie->getId() . '_' . $i;?>
                    <img id="<?= $id_estrella?>" class="estrella estrella_vacia" data-puntuacion="<?= $i ?>" data-serieid="<?= $serie->getId()?>" src="img/star.png" alt="empty star" width="20" height="20">
                
                    <input type="hidden" name="serieid" value="<?php echo $serie->getId(); ?>">
                <?php }
            ?></td>
        </tr>
       
<?php endforeach; ?>
</table>

<?php include_once '../app/views/general/footer.php';?>

<script src="../assets/js/puntuar.js"></script>

