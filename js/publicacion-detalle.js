$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
  	responsive:{
  	    0:{
  	        items:1,
			loop:true,
			margin:10,
			responsiveClass:true,
			autoplay:true,
			center: true,
			nav:true,
			navText:['Anterior','Siguiente']
  	    }
  	}

  });
  $('#btn-preguntar').on('click', realizarPregunta);
});

function realizarPregunta(){
	let pregunta = $.trim($('#txt-pregunta').val());
	let idPublicacion = $(this).attr('data-id-publicacion');
	if(pregunta.length > 0){
		let parametros = {pregunta : pregunta, idPublicacion: idPublicacion};
		$.ajax({
			url: 'Publicacion/realizarPregunta',
			data: parametros,
			type: 'POST',
			success: function(result){
				$('#txt-pregunta').val('');
		   		$('.preguntas').append(result);
			}
		});
	}
}