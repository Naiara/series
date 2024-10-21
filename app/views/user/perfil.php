<!-- cargar el header y el menu de otro fichero php -->
<?php include_once '../app/views/general/header.php';?>
    <h1>Perfil del Usuario</h1>
    <p><strong>Nombre:</strong> <?= $_SESSION['user']['name'] ?></p>
    <p><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Role:</strong> <?php echo htmlspecialchars($_SESSION['user']['role'], ENT_QUOTES, 'UTF-8'); ?></p>
    <a href="index.php?controller=usuario&action=update&id=<?= $_SESSION['user']['id'] ?>" class="btn btn-primary">Editar</a>
    <a href="index.php?controller=usuario&action=updatePass&id=<?= $_SESSION['user']['id'] ?>" class="btn btn-danger">Cambiar contraseña</a>
    
    <?php include '../app/views/general/footer.php'; ?>