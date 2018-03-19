<!DOCTYPE html>
<html lang="en">
  
  {include file='header.tpl'}

  <body>

    {include file='navBar.tpl'}
    <!-- Page Content -->
    <div id="contenedor-panel" class="container">
    	<h3 class="my-4">
    		Bienvenido/a a tu panel de usuario, {$usuarioLogueado.nombre}.
    	</h3>
    	<div class="row">
    		{if $tienePublicaciones}
    			<div>Estas son tus publicaciones en Phperros&Cia:</div>
    			<div class="table-responsive">
	    			<table class="table">
	    			  <thead>
	    			    <tr>
	    			      <th scope="col">Titulo</th>
	    			      <th scope="col">Tipo</th>
	    			      <th scope="col">Estado</th>
	    			      <th scope="col">Acciones</th>
	    			    </tr>
	    			  </thead>
	    			  <tbody>
	    			  	{foreach from=$publicaciones item=pub }
	    			    <tr>
	    			      <td scope="row">{$pub.titulo}</td>
	    			      <td>{$pub.tipo}</td>
	    			      <td>{$pub.estado}</td>
	    			      <td>
	    			      	<a href="Publicacion/verDetalle/{$pub.id}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-external-link"></i> Ver </a>
	    			      	<a href="Publicacion/generarPublicacionPDF/{$pub.id}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i> Generar PDF</a>
	    			      </td>
	    			    </tr>
	    			   {/foreach}
	    			  </tbody>
	    			</table>
	    		</div>
    		{else}
				<div class="alert alert-danger center" style="width:100%;"><i class='fa fa-exclamation-triangle'></i> Aún no tienes publicaciones en Phperros&Cia.</div>
				<div><a href="Publicacion/registro" class="btn btn-success"><i class='fa fa-pencil'></i> Haz tu primer publicación!</a></div>
    		{/if}
    	</div>
    	<hr>
    	<div class="row">
    		<a href="PanelUsuario/verEstadisticas" class="btn btn-success"><i class='fa fa-bar-chart'></i> Ver estadísticas de Phperros&Cia.</a>
    	</div>
    </div>
    {include file='footer.tpl'}

  </body>

</html>
