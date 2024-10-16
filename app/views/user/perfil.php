<!-- cargar el header y el menu de otro fichero php -->
<?php include_once '../app/views/general/header.php';?>
    <h1>Perfil del Usuario</h1>
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['name'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($usuario['username'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Role:</strong> <?php echo htmlspecialchars($usuario['role'], ENT_QUOTES, 'UTF-8'); ?></p>
    <a href="index.php?controller=usuario&action=update&id=<?= $usuario['id'] ?>" class="btn btn-primary">Editar</a>
    <a href="index.php?controller=usuario&action=updatePass&id=<?= $usuario['id'] ?>" class="btn btn-danger">Cambiar contraseña</a>
    
    <?php include '../app/views/general/footer.php'; ?>