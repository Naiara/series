<?php include_once '../app/views/general/header.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
    }else{
        $id = $usuario->getID();
        $name = $usuario->getName();
        $username = $usuario->getUsername();
        $email = $usuario->getEmail();
        $role = $usuario->getRole();
    }    
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Cambiar datos usuario</h2>
        <form method="POST" action="index.php?controller=usuario&action=update">
            <input type="hidden" name="id" value="<?= $usuario->getId() ?>">
            
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
            <?php if($_SESSION['user']['role']=='admin' || $usuario->getId() != $_SESSION['user']['id']){ ?>
                <label for="role" class="form-label">Rol de usuario:</label>
                <select class="form-control"  name="role" id="role">
                    <option value="usuario" <?= ($role == 'usuario') ? "selected" : ""; ?> >Usuario común</option>
                    <option value="admin"  <?= ($role == 'admin') ? "selected" : ""; ?>>Administrador</option>
                </select>
            <?php } ?>

            <!-- Botón de enviar -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Guardar información </button>
            </div>
        </form>
    </div>
</div>
<?php include '../app/views/general/footer.php'; ?>
