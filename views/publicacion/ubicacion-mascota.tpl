{if $existenCoordenadas}
	<div>
		<hr>
		{if $publicacion.tipo == 'E'}
			<h4>Encontrado en:</h4>
		{else}
			<h4>Perdido en las inmediaciones:</h4>
		{/if}
		<div id="map" style="height: 250px;margin-top: 5px;"></div>
	</div>
{/if}