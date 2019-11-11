<section id='seccion-preguntas'>
	<h3><i class='fa fa-comments'></i> Preguntas y respuestas</h3>
	<ul class='preguntas'>
		{if count($preguntas) > 0}
				{foreach from=$preguntas item=preg}
					<li class='pregunta-respuesta'>
						<article class='pregunta'><i class='fa fa-comment'></i> {$preg.nombre_usuario}: {$preg.texto}</article>
						{if !is_null($preg.respuesta)}
							<article class='respuesta'><i class='fa fa-comment icono-invertido'></i> {$preg.respuesta}</article>
						{else if $hayUsuarioLogueado && $usuarioLogueado.id == $publicacion.usuario_id}
							<div class='row row-responder'>
								<div class='col-xs-12 col-sm-6 col-lg-8'>
									 <textarea class='form-control' rows='1'></textarea>
								</div>
								<div class='col-xs-6 col-lg-4'>
									<button class='btn btn-success btn-sm btn-responder' data-id-pregunta='{$preg.id}'>Responder</button>
								</div>
							</div>
						{/if}
					</li>
				{/foreach}
		{else}
			<div class="alert alert-danger alert-chico" role="alert"> <i class="fa fa-exclamation-triangle"></i> No hay preguntas en esta publicación aún</div>
		{/if}
	</ul>
</section>
<section id='seccion-nueva-pregunta'>
	{if $hayUsuarioLogueado}
		{if $usuarioLogueado.id !== $publicacion.usuario_id}
			<h4>Haz una pregunta!</h4>		
			<div class='row row-preguntar'>
				<div class='col-xs-12 col-sm-6 col-lg-8'>
					 <textarea class='form-control' rows='2' id='txt-pregunta'></textarea>
				</div>
				<div class='col-xs-6 col-lg-4'>
					<button id='btn-preguntar' data-id-publicacion='{$publicacion.id}' class='btn btn-success'><i class="fa fa-pencil"></i> Nueva pregunta</button>
				</div>
			</div>
		{/if}
	{else}
		<div class='row row-preguntar'>
			<div class='col-xs-12 col-sm-6 col-lg-8'>
				<a class='btn btn-danger' href='Login'><i class="fa fa-sign-in"></i> Inicia sesión para realizar una pregunta</a>
			</div>
		</div>
	{/if}
</section>