
    <?php require_once '../app/views/general/header.php'; ?>
    <h2>Añadir serie</h2>
    <?php if(isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form action="index.php?controller=serie&action=add" method="post">
        <label for="title">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br>
        <label for="isan">ISAN:</label>
        <input type="text" id="isan" name="isan" required><br>
        <label for="estreno">Año:</label>
        <input type="text" id="estreno" name="estreno" required><br><br>
        <label for="descripcion">Description:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Add Series">
    </form>
<?php require_once '../app/views/general/footer.php'; ?>
<script src="https://cdn.tiny.cloud/1/ruxaeqofx0hkoil6eqeq4oj6lusi5duxpv68t9pbj488js85/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
