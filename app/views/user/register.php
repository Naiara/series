<?php include_once '../app/views/general/header.php';?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Registrar usuario</h2>
        <form method="POST" action="index.php?controller=usuario&action=register">
            <label for="name">Nombre</label>
            <input type="text" name="name" placeholder="Nombre" required><br>
            <label for="username">Nombre de usuario</label>
            <input type="text" name="username" placeholder="Nombre de usuario" required><br>
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" placeholder="Nombre de usuario" required><br>
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <label for="role">Rol de usuario:</label>
            <select name="role" id="role">
                <option value="usuario" selected>Usuario común</option>
                <option value="admin">Administrador</option>
            </select>
            <button type="submit">Registrar</button>


        </form>
    </div>
</div>
<?php include '../app/views/general/footer.php'; ?>
