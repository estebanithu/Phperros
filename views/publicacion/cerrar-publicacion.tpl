{if $hayUsuarioLogueado}
	{if $usuarioLogueado.id == $publicacion.usuario_id && $publicacion.abierta == 1}
	<hr>
	<h4>Cerrar publicación</h4>
		<div class="input-group cerrar-publicacion">
		  <select class="custom-select" id="select-publicacion-exito">
		    <option selected>¿Con éxito?</option>
		    <option value="1">Sí</option>
		    <option value="0">No</option>
		  </select>
		  <div class="input-group-append">
		    <button class="btn btn-danger" id='btn-cerrar-publicacion' type="button" data-id-publicacion="{$publicacion.id}"><i class="fa fa-key"></i> Cerrar publicación</button>
		  </div>
		</div>
		<div id='cerrar-publicacion-respuesta'></div>
	{/if}
{/if}