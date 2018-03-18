{include file='header.tpl'}
<body>
<script type='text/javascript' src='js/owl.carousel.min.js'></script>
<script type='text/javascript' src='js/publicacion-detalle.js'></script>
<link rel='stylesheet' type='text/css' href='css/publicacion-detalle.css'>
{include file='navBar.tpl'}
{if $publicacion.abierta == 0}
	<div id="alert-publicacion-cerrada" class="alert alert-warning center">
	  <i class="fa fa-exclamation-triangle"></i> <strong>Atención!</strong> Esta publicación ya ha sido cerrada.
	</div>
{/if}
<div id='contenedor-publicacion' class='container'>
	<h1>{$publicacion.titulo}</h1>
	<div>{$publicacion.especie} > {$publicacion.raza}</div>	
	<section id='contenedor-galeria-descripcion'>
	<div class='row'>
		<div class='col-xs-12 col-sm-6 col-lg-8' id='galeria'>
			<div class='owl-carousel owl-theme'>
				{if count($imagenes) > 0}
					{foreach from=$imagenes item=img}
						<div><img class='img-responsive' src='{$img}'></div>
					{/foreach}
				{else}
					<div><img src="img/defecto.png"></div>
				{/if}
			</div>
		</div>
		<div id='descripcion' class='col-xs-6 col-lg-4'>
			{if $publicacion.tipo == 'E'}
				<div class='alert alert-success alert-chico' role='alert'><i class='fa fa-check-circle'></i> Encontrado</div>
			{else}
				<div class='alert alert-danger alert-chico' role='alert'><i class='fa fa-search'></i> Perdido</div>
			{/if}
			<h4>Descripción</h4>
			{$publicacion.descripcion}
		<hr>
		<div>
			<h4>Contacto</h4>
			<div><i class='fa fa-user'></i> {$publicacion.usr_nom}</div>
			<div><i class='fa fa-envelope'></i> <a href='mailto:{$publicacion.usr_email}' target='_top'>{$publicacion.usr_email}</a></div>
		</div>
			{include file='publicacion/cerrar-publicacion.tpl'}	
			<hr>
			<div>
				<a href="Publicacion/generarPublicacionPDF/{$publicacion.id}" target="_blank" class="btn btn-success"><i class='fa fa-file-pdf-o'></i> Generar PDF</a>
			</div>
		</div>
	</section>
	<hr>
	{include file='publicacion/preguntas-y-respuestas.tpl'}	
</div>
	{include file='footer.tpl'}
</body>