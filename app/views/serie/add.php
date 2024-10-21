
    <?php require_once '../app/views/general/header.php'; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Añadir serie</h2>
            <form action="index.php?controller=serie&action=add" method="post">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Introduce el título" required>
                </div>
                <div class="mb-3">
                    <label for="isan" class="form-label">ISAN:</label>
                    <input type="text" class="form-control" id="isan" name="isan" placeholder="Introduce el ISAN" required>
                </div>
                <div class="mb-3">
                    <label for="estreno" class="form-label">Año de estreno:</label>
                    <input type="text" class="form-control" id="estreno" name="estreno" placeholder="Introduce el año de estreno" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" class="form-control" name="descripcion" rows="4" cols="50" required></textarea>             

                <!-- Botón de enviar -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Añadir Series</button>
                </div>
            </form>
        </div>
    </div>
<?php require_once '../app/views/general/footer.php'; ?>
<script src="https://cdn.tiny.cloud/1/ruxaeqofx0hkoil6eqeq4oj6lusi5duxpv68t9pbj488js85/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
