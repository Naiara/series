
    <?php require_once '../app/views/general/header.php'; ?>
    <h2>Editar serie</h2>
    <?php if(isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form action="index.php?controller=serie&action=update" method="post">
        <input type="hidden" id="id" name="id" value="<?= $serie->getId()?>"><br>
        <label for="title">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?= $serie->getTitulo()?>" required><br>
        <label for="isan">ISAN:</label>
        <input type="text" id="isan" name="isan" value="<?= $serie->getIsan()?>" required><br>
        <label for="estreno">Año:</label>
        <input type="text" id="estreno" name="estreno" value="<?= $serie->getEstreno()?>" required><br><br>
        <label for="descripcion">Description:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50"  required> <?= $serie->getDescripcion()?></textarea><br><br>

        <input type="submit" value="Guardar">
    </form>
<?php require_once '../app/views/general/footer.php'; ?>