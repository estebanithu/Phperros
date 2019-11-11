<!DOCTYPE html>
<html lang="en">
  
  {include file='header.tpl'}

  <body>

    {include file='navBar.tpl'}
    <!-- Page Content -->
    <div id="contenedor-panel" class="container">
    	<div class="row" style="float: right;">
    		<a href="PanelUsuario/verEstadisticas" class="btn btn-primary"><i class='fa fa-bar-chart'></i> Ver estadísticas de {$nombreSitio}</a>
    	</div>
    	<h3 class="my-4">
    		Bienvenido/a a tu panel de usuario, {$usuarioLogueado.nombre}.
    	</h3>
    	<div class="row">
    		{if $tienePublicaciones}
    			{include file='panelUsuario/publicaciones-usuario.tpl'}
    		{else}
				<div class="alert alert-danger center" style="width:100%;"><i class='fa fa-exclamation-triangle'></i> Aún no tienes publicaciones en {$nombreSitio}</div>
				<div><a href="Publicacion/registro" class="btn btn-success"><i class='fa fa-pencil'></i> Haz tu primer publicación!</a></div>
    		{/if}
    	</div>
    	<hr>
    	<div class="row">
            {if $tienePublicaciones}
    		  <a href="Publicacion/registro" class="btn btn-success"><i class='fa fa-pencil'></i> Registra una nueva publicación!</a>
            {/if}
    	</div>
    </div>
    {include file='footer.tpl'}

  </body>

</html>
