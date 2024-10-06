<?php include '../app/views/general/encabezado.php'; ?>
<form method="POST" action="register.php">
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Registrar</button>
</form>
<?php include '../app/views/general/footer.php'; ?>
