
<nav class="navbar  sticky-top navbar-expand-lg  navbar-dark bg-info">
  <a class="navbar-brand" href="index.php?action=inicio">INICIO
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
          <li class="nav-item">
        <a class="nav-link text-white" href="index.php?action=login">LOGIN</a>
      </li>
  
    </ul>

    <form class="form-inline my-2 my-lg-0" method="post">
      <input class="form-control mr-lg-4" type="search" name="buscado" placeholder="Buscar Productos" aria-label="Search">
      <button class="btn btn-success my-6 my-sm-0" type="submit">Buscar<i class="fa fa-search ml-2"></i></button>
    </form>

<?php
$respuesta = new MvcControlador();
$respuesta -> buscarComercioControlador();
        ?>
  </div>
</nav>

