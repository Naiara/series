<?php 
    include '../app/views/general/header.php'; 
    if(isset($_SESSION['user'])){
        var_dump($_SESSION['user']) ;
    }else{
        echo 'No hay usuario';
    }

    if (isset($error)) echo $error;
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <form method="POST" action="index.php?controller=usuario&action=login">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</div>


<?php include '../app/views/general/footer.php'; ?>
