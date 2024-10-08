<?php 
    if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin'){
        header('Location: /');
    }

    include_once '../app/views/general/header.php';?>
<h1>Usuarios</h1>
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
            
        <tr>
            <td ><?php echo $usuario->getName(); ?></td>
            <td><?php echo $usuario->getEmail(); ?></td>
            <td><?php echo $usuario->getUsername(); ?></td>
            <td><?php echo ucfirst($usuario->getRole()); ?></td>
            <td>
                <?php if($usuario->getRole() !== 'admin'){ ?>
                    <a href="/usuario/editar?id=<?php echo $usuario->getId(); ?>"><img class="icono" src="img/edit.png" alt=""></a>
                    <a href="/usuario/borrar?id=<?php echo $usuario->getId(); ?>"><img class="icono" src="img/trash.png" alt=""></a>
                <?php }else{ ?>
                    <img class="icono" src="img/lock.png" alt="">
                <?php } ?>    
            </td>
        </tr>
       
<?php endforeach; ?>
</table>

<?php include_once '../app/views/general/footer.php';?>
