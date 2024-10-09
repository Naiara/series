<?php
  if(isset($_SESSION['user'])){
?>
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <a  class="nav-link active" href="/index.php?controller=serie&action=index">Todas las series</a>
      <a  class="nav-link" href="/index.php?controller=serie&action=puntuar">Mis puntuaciones</a>
      <?php
        if($_SESSION['user']['role'] == 'admin'){
      ?>
          <a  class="nav-link" href="/index.php?controller=serie&action=gestion">Gestionar series</a>
          <!-- <a  class="nav-link" href="/index.php?controller=serie&action=index">Editar series</a> -->
          <a  class="nav-link" href="/index.php?controller=usuario&action=index">Gestionar usuarios</a>
      <?php
        }
      ?>
      <a  class="nav-link" href="/index.php?controller=Usuario&action=perfil">Mi perfil</a>
      <a  class="nav-link" href="/index.php?controller=Usuario&action=logout">Salir</a>
    </div>
</nav>

<?php
  }
?>
<!--     <ul>
        <li><a href="/index.php?controller=serie&action=index">Todas las series</a></li>
        <li><a href="/index.php?controller=serie&action=puntuar">Mis puntuaciones</a></li>
        <li><a href="/index.php?controller=Usuario&action=perfil">Mi perfil</a></li>
        <li><a href="/index.php?controller=Usuario&action=logout">Salir</a></li>
    </ul>
</nav> -->