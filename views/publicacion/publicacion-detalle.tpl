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
			<h4>Descripción</h4>
			{$publicacion.descripcion}
		<hr>
		<div>
			<h4>Contacto</h4>
			<div><i class="fa fa-user"></i> {$publicacion.usr_nom}</div>
			<div><i class="fa fa-envelope"></i> <a href="mailto:{$publicacion.usr_email}" target="_top">{$publicacion.usr_email}</a></div>
		</div>
		</div>
	</section>
	<hr>
	<section id="seccion-preguntas">
		<h3><i class="fa fa-comments"></i> Preguntas y respuestas</h3>
		<ul class="preguntas">
			{foreach from=$preguntas item=preg}
				<li class="pregunta-respuesta" style="list-style:  none; border-bottom: 1px solid rgba(0,0,0,.1); padding-bottom: 10px;padding-top: 10px;">
					<article class="pregunta" style="margin-bottom: 5px;"><i class="fa fa-comment"></i> {$preg.nombre}: {$preg.texto}</article>
					{if !is_null($preg.respuesta)}
						<article class="respuesta" style="margin-left: 15px;"><i style="  -webkit-transform:rotateY(180deg);  -moz-transform:rotateY(180deg);  -o-transform:rotateY(180deg);  -ms-transform:rotateY(180deg);" class="fa fa-comment"></i> {$preg.respuesta}</article>
					{/if}
				</li>
			{/foreach}
		</ul>
	</section>
	<section id="seccion-respuesta">
		{if $hayUsuarioLogueado}
			{if $usuarioLogueado.id !== $publicacion.usuario_id}
				<h4>Haz una pregunta!</h4>		
				<div class="row" style="margin-bottom: 10px;">
					<div class="col-xs-12 col-sm-6 col-lg-8">
						 <textarea class="form-control" rows="2" id="txt-pregunta"></textarea>
					</div>
					<div class="col-xs-6 col-lg-4">
						<button id="btn-preguntar" data-id-publicacion='{$publicacion.id}' class="btn btn-success" style="margin-top: 3%;">Preguntar</button>
					</div>
				</div>
			{else}
				<div>Respuesta!!!</div>
			{/if}
		{else}
			<div class="row" style="margin-bottom: 10px;">
				<div class="col-xs-12 col-sm-6 col-lg-8">
					<a class="btn btn-danger" href="Login">Inicia sesión para realizar una pregunta</a>
				</div>
			</div>
		{/if}
	</section>
	
</div>
	{include file='footer.tpl'}
</body>