<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="Index">Phperros&Cia.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          {if !isset($buscadorsinform)}
            <form id="form_busqueda" method="GET" action="Publicacion/vertodas">
                <div class="input-group mb-3">
                  <div class="input-group-prepend" 
                      onclick="document.getElementById('form_busqueda').submit();return false;">
                        <a class="fa fa-search input-group-text" style="color:gray"></a>
                  </div>
                   <input id="search-input" class="form-control input-md" placeholder="Buscar..." autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1" name="busqueda"
                   value="{$busqueda}">
                </div>
            </form>
          {else}
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                        <a class="fa fa-search input-group-text" style="color:gray"></a>
                  </div>
                   <input id="search-input" class="form-control input-md" placeholder="Buscar..." autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1" name="busqueda"
                   value="{$busqueda}">
                </div>
          {/if}
        </li>
         {if ($hayUsuarioLogueado)}
          <li class="nav-item active">
              <a class="nav-link" href="">Hola, {$usuarioLogueado.nombre}!</a>
              <span class="sr-only">(current)</span>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="Login/logout"><i class='fa fa-sign-out'></i> Cerrar sesión</a>
          </li>
          {else}
              <a class="nav-link" href="Login"><i class='fa fa-sign-in'></i> Iniciar sesión</a>
              <span class="sr-only">(current)</span>
          {/if}
      </ul>
    </div>
  </div>
</nav>