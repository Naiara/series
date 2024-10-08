<?php 
    if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin'){
        header('Location: /');
    }

    include_once '../app/views/general/header.php';?>
<h2>Usuarios</h2>
<a href="/index.php?controller=usuario&action=register" class="btn btn-primary">Añadir usuario</a>
<table class="table">
    <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Nombre de usuario</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
<?php 
foreach ($usuarios as $usuario): ?>
            
        <tr id="usuario_<?= $usuario->getId() ?>" >
            <td ><?php echo $usuario->getName(); ?></td>
            <td><?php echo $usuario->getEmail(); ?></td>
            <td><?php echo $usuario->getUsername(); ?></td>
            <td><?php echo ucfirst($usuario->getRole()); ?></td>
            <td>
                <?php if($usuario->getRole() !== 'admin'){ ?>
                    <img class="icono editar_usuario" src="img/edit.png" alt=""></a>
                    <img class="icono eliminar_usuario" data-usuarioid="<?= $usuario->getId()?>" src="img/trash.png" alt=""></a>
                <?php }else{ ?>
                    <img class="icono" src="img/lock.png" alt="">
                <?php } ?>    
            </td>
        </tr>
       
<?php endforeach; ?>
</table>

<?php include_once '../app/views/general/footer.php';?>


<script src="../assets/js/usuarios.js"></script>
