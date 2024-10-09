<?php include_once '../app/views/general/header.php';?>

<?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){ ?>
<h1>Series</h1>
<a href="/index.php?controller=serie&action=add" class="btn btn-primary">Añadir serie</a>
<table class="table">
    <tr>
        <th>Título</th>
        <th>ISAN</th>
        <th>descripcion</th>
        <th>Año</th>
        <th>Acciones</th>
    </tr>
<?php foreach ($series as $serie): ?>
            
        <tr id="serie_<?= $serie->getId() ?>" >
            <td ><?php echo $serie->getTitulo(); ?></td>
            <td><?php echo $serie->getDescripcion(); ?></td>
            <td>FALTA</td>
            <td>FALTA</td>
            <td>
                <img class="icono editar_serie" src="img/edit.png" alt=""></a>
                <img class="icono eliminar_serie" data-id="<?= $serie->getId()?>" src="img/trash.png" alt=""></a>  
            </td>
        </tr>
       
<?php endforeach; ?>
</table>

<?php include_once '../app/views/general/footer.php';?>

<script src="../assets/js/series.js"></script>

<?php } ?>
