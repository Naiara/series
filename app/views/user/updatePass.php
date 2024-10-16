<?php include_once '../app/views/general/header.php';?>
<h2>Cambiar datos usuario</h2>
<form method="POST" action="index.php?controller=usuario&action=update">
    <input type="hidden" name="id" value="<?= $usuario->getId() ?>"><br>
    <label for="name">Antiguo password</label>
    <input type="text" name="password" required><br>
    <label for="newPassword">Nombre</label>
    <input type="text" name="newPassword" required><br>
    <label for="newPassword2">Nombre de usuario</label>
    <input type="text" name="newPassword2" required><br>
    <button type="submit">Guardar</button>


</form>
<?php include '../app/views/general/footer.php'; ?>
