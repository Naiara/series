<?php include_once '../app/views/general/header.php';?>
<h2>Cambiar datos usuario</h2>
<form method="POST" action="index.php?controller=usuario&action=update">
    <input type="hidden" name="id" value="<?= $usuario->getId() ?>"><br>
    <label for="name">Nombre</label>
    <input type="text" name="name" value="<?= $usuario->getName() ?>" required><br>
    <label for="username">Nombre de usuario</label>
    <input type="text" name="username" value="<?= $usuario->getUsername() ?>" required><br>
    <label for="email">Correo electrónico</label>
    <input type="email" name="email"  value="<?= $usuario->getEmail() ?>" required><br>
    <?php if($_SESSION['user']['role']=='admin' || $usuario->getId() != $_SESSION['user']['id']){ ?>
        <label for="role">Rol de usuario:</label>
        <select name="role" id="role">
            <option value="usuario" <?= ($usuario->getRole() == 'usuario') ? "selected" : ""; ?> >Usuario común</option>
            <option value="admin"  <?= ($usuario->getRole() == 'admin') ? "selected" : ""; ?>>Administrador</option>
        </select>
    <?php } ?>
    <button type="submit">Guardar</button>


</form>
<?php include '../app/views/general/footer.php'; ?>
