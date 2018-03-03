<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="Index">Phperros&Cia.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">

        {if ($hayUsuarioLogueado)}
          <li class="nav-item active">
              <a class="nav-link" href="">Hola, {$usuarioLogueado.nombre}!</a>
              <span class="sr-only">(current)</span>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="Login/logout">Cerrar sesión</a>
          </li>
          {else}
              <a class="nav-link" href="Login">Iniciar sesión</a>
              <span class="sr-only">(current)</span>
          {/if}
        </li>
      </ul>
    </div>
  </div>
</nav>