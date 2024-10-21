<?php
  if(isset($_SESSION['user'])){
    $controller = $_GET['controller'];
    $action = $_GET['action'];
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">  
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php?controller=serie&action=index">Mi Sitio Web</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="<?= ($controller == 'serie' && $action == 'index') ? 'active':'' ?> nav-link" href="/index.php?controller=serie&action=index">Todas las series</a>
              </li>
              <li class="nav-item">
                <a class="<?= ($controller == 'serie' && $action == 'puntuar') ? 'active':'' ?> nav-link" href="/index.php?controller=serie&action=puntuar">Mis puntuaciones</a>
              </li>
              <?php
                if($_SESSION['user']['role'] == 'admin'){
              ?>
                  <li class="nav-item">
                    <a class="<?= ($controller == 'serie' && $action == 'gestion') ? 'active':'' ?> nav-link" href="/index.php?controller=serie&action=gestion">Gestionar series</a>
                  </li>
                  <li class="nav-item">
                    <a class="<?= ($controller == 'usuario' && $action == 'index') ? 'active':'' ?> nav-link" href="/index.php?controller=usuario&action=index">Gestionar usuarios</a>
                  </li>
              <?php
                } 
              ?>
              <li class="nav-item">
                <a class="<?= ($controller == 'usuario' && $action == 'perfil') ? 'active':'' ?> nav-link" href="/index.php?controller=usuario&action=perfil">Mi perfil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/index.php?controller=usuario&action=logout">Salir</a>
              </li>
        </ul>
    </div>
  </div>
</nav>

<?php
  }
?>
