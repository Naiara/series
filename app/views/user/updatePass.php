<?php include_once '../app/views/general/header.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
    }else{
        $id = $usuario->getId();
    }
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Cambiar contraseña usuario</h2>

        <!-- Formulario -->
        <form method="POST" action="index.php?controller=usuario&action=updatePass">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Contraseña Actual</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Introduce tu contraseña actual" required>
            </div>

            <!-- Nueva contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Introduce una nueva contraseña" required>
            </div>

            <!-- Confirmar nueva contraseña -->
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirma la nueva contraseña" required>
                <div class="invalid-feedback" id="passwordError">
                    Las contraseñas no coinciden.
                </div>
            </div>

            <!-- Botón de enviar -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
            </div>
        </form>
    </div>
</div>
<?php include '../app/views/general/footer.php'; ?>

<!-- cargar script para confirmar contraseña -->
<script src="../assets/js/confirmPassword.js"></script>
