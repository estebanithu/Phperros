{include file='header.tpl'}
<body>
<script type='text/javascript' src='js/owl.carousel.min.js'></script>
<script type='text/javascript' src='js/publicacion-detalle.js'></script>
<link rel='stylesheet' type='text/css' href='css/publicacion-detalle.css'>
{include file='navBar.tpl'}
<div id='contenedor-publicacion' class='container'>
	<h1>{$publicacion.titulo}</h1>
	<div>{$publicacion.especie} > {$publicacion.raza}</div>	
	<section id='contenedor-galeria-descripcion'>
	<div class='row'>
		<div class='col-xs-12 col-sm-6 col-lg-8' id='galeria'>
			<div class='owl-carousel owl-theme'>
				{foreach from=$imagenes item=img}
					<div><img class='img-responsive' src='{$img}'></div>
				{/foreach}
			</div>
		</div>
		<div id='descripcion' class='col-xs-6 col-lg-4'>
			{if $publicacion.tipo == 'E'}
				<div class='alert alert-success alert-chico' role='alert'>Encontrado</div>
			{else}
				<div class='alert alert-danger alert-chico' role='alert'>Perdido</div>
			{/if}
			<h4>Descripción</h4>
			{$publicacion.descripcion}
		<hr>
		<div>
			<h4>Contacto</h4>
			<div><i class='fa fa-user'></i> {$publicacion.usr_nom}</div>
			<div><i class='fa fa-envelope'></i> <a href='mailto:{$publicacion.usr_email}' target='_top'>{$publicacion.usr_email}</a></div>
		</div>
		{if $hayUsuarioLogueado}
			{if $usuarioLogueado.id == $publicacion.usuario_id}
			<hr>
			<h4>Cerrar Publicación</h4>
				<div class="input-group cerrar-publicacion">
				  <select class="custom-select" id="inputGroupSelect04">
				    <option selected>¿Con éxito?</option>
				    <option value="1">Sí</option>
				    <option value="0">No</option>
				  </select>
				  <div class="input-group-append">
				    <button class="btn btn-danger" type="button"><i class="fa fa-key"></i> Cerrar publicación</button>
				  </div>
				</div>
			{/if}
		{/if}
		</div>
	</section>
	<hr>
	{include file='publicacion/preguntas-y-respuestas.tpl'}	
</div>
	{include file='footer.tpl'}
</body>