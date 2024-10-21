<?php include_once '../app/views/general/header.php';
    //comprobar si hay algun envio de datos	
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $role = $_POST['role'];
    }else{
        $name = "";
        $username = "";
        $email = "";
        $password = "";
        $password2 = "";
        $role = "";
    } ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Registrar usuario</h2>
        <form method="POST" action="index.php?controller=usuario&action=register">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Introduce el nombre" required value="<?= $name ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" required value="<?= $username ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required value="<?= $email ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required value="<?= $password ?>">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirmación de contraseña</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirmación de contraseña" required value="<?= $password2 ?>">
            </div>
            <?php if($_SESSION['user']['role']=='admin' || $usuario->getId() != $_SESSION['user']['id']){ ?>
                <label for="role" class="form-label">Rol de usuario:</label>
                <select class="form-control"  name="role" id="role">
                    <option value="usuario" <?= ($role == 'usuario') ? "selected" : ""; ?> >Usuario común</option>
                    <option value="admin"  <?= ($role == 'admin') ? "selected" : ""; ?>>Administrador</option>
                </select>
            <?php } ?>

            <!-- Botón de enviar -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Registrar usuario </button>
            </div>

        </form>
    </div>
</div>
<?php include '../app/views/general/footer.php'; ?>


<!-- cargar script para confirmar contraseña -->
<script src="../app/assets/js/confirmPassword.js"></script>
