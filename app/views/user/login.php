<?php 
    include '../app/views/general/header.php'; 
    if(isset($_SESSION['user'])){
        header('Location: /');
    }/* else{
        echo 'No hay usuario';
    }
 */
    if (isset($error)) echo $error;
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <form method="POST" action="index.php?controller=usuario&action=login">
            
            <div class="mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Introduce el nombre de usuario" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Introduce la contraseña" required>
            </div>
            
            <!-- Botón de enviar -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Iniciar Sesión </button>
            </div>
        </form>
    </div>
</div>


<?php include '../app/views/general/footer.php'; ?>
