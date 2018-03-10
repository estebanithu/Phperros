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
  $('.btn-responder').on('click', responderPregunta);
  $('#btn-cerrar-publicacion').on('click', cerrarPublicacion);
  
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

function responderPregunta(){
	let row = $(this).parent().parent();
	let respuesta = $.trim(row.find('textarea').val());
	let idPregunta = $(this).attr('data-id-pregunta');
	let li = $(this).closest('li[class^="pregunta-respuesta"]');
	if(respuesta.length > 0){
		let parametros = {respuesta : respuesta, idPregunta: idPregunta};
		$.ajax({
			url: 'Publicacion/responderPregunta',
			data: parametros,
			type: 'POST',
			success: function(result){
				row.remove();
		   		li.append(result);
			}
		});
	}
}

function cerrarPublicacion(){
	let exito = $("#select-publicacion-exito").val();
	if(exito == '1' || exito == '0'){
		let idPublicacion = $(this).attr('data-id-publicacion');
		let parametros = {idPublicacion: idPublicacion, exito: exito};
		$.ajax({
			url: 'Publicacion/cerrarPublicacion',
			data: parametros,
			type: 'POST',
			success: function(result){

			}
		});
	}
}