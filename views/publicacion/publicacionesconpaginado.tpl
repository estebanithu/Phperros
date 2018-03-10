<div id="container-publicaciones-paginado">
	{if $canttotalpublicaciones>0}
	<div id="container-publicaciones" class="row">
		{include file='publicacion/publicaciones.tpl'}
	</div>
	<div class="row">
		{include file='paginacion.tpl'}
	</div>
	{else}
		<h3>No existen publicaciones para los filtros aplicados</h3>
	{/if}
</div>