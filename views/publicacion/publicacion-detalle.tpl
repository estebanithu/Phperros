{include file='header.tpl'}
<body>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/publicacion-detalle.js"></script>
{include file='navBar.tpl'}
<div class="container" style="margin-top: 20px;">
	<h1>{$publicacion.titulo}</h1>

	<div>{$publicacion.especie} > {$publicacion.raza}</div>	
	<section id="contenedor-galeria-descripcion" style="padding: 1%;">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-8" id="galeria">
			<div class="owl-carousel owl-theme">
				{foreach from=$imagenes item=img}
					<div><img class="img-responsive" src="{$img}"></div>
				{/foreach}
			</div>
		</div>
		<div id="descripcion" class="col-xs-6 col-lg-4" style="text-align: justify;">
			{if $publicacion.tipo == 'E'}
				<div class="alert alert-success" role="alert" style="text-align: center;padding: 0;" >Encontrado</div>
			{else}
				<div class="alert alert-danger" role="alert"  style="text-align: center;padding: 0;">Perdido</div>
			{/if}
			{$publicacion.descripcion}
		</div>
	</section>
	<hr>
	<section id="seccion-preguntas">
		<h3><i class="fas fa-comments"></i> Preguntas y respuestas</h3>
		<ul class="preguntas">
			{foreach from=$preguntas item=preg}
				<li class="pregunta-respuesta" style="list-style:  none; border-bottom: 1px solid rgba(0,0,0,.1);">
					<article class="pregunta">{$preg.texto}</article>
					<article class="respuesta" style="margin-left: 2%;">{$preg.respuesta}</article>
				</li>
			{/foreach}
		</ul>
	</section>
	
</div>
	{include file='footer.tpl'}
</body>