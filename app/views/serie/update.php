
    <?php require_once '../app/views/general/header.php'; 
        //comprobar si hay algun envio de datos	
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $isan = $_POST['isan'];
            $estreno = $_POST['estreno'];
        }else{
            $id = $serie->getID();
            $titulo = $serie->getTitulo();
            $descripcion = $serie->getDescripcion();
            $isan = $serie->getIsan();
            $estreno = $serie->getEstreno();
        }    
    ?>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Editar serie</h2>
            <form action="index.php?controller=serie&action=update" method="post">                
                <input type="hidden" id="id" name="id" value="<?= $id ?>">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Introduce el título" value="<?= $titulo?>" required>
                </div>
                <div class="mb-3">
                    <label for="isan" class="form-label">ISAN:</label>
                    <input type="text" class="form-control" id="isan" name="isan" placeholder="Introduce el ISAN" value="<?= $isan ?>" required maxlength="8">
                </div>
                <div class="mb-3">
                    <label for="estreno" class="form-label">Año de estreno:</label>
                    <input type="text" class="form-control" id="estreno" name="estreno" placeholder="Introduce el año de estreno" value="<?= $estreno ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" class="form-control" name="descripcion" rows="4" cols="50" required><?= $descripcion ?></textarea>

                <!-- Botón de enviar -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Guardar información </button>
                </div>
            </form>
        </div>
    </div>
<?php require_once '../app/views/general/footer.php'; ?>