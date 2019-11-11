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
				let clase = 'alert-danger';
				let icono = '<i class="fa fa-exclamation-triangle"></i>';
				let respuesta = $.parseJSON(result);
				if(!respuesta.error){
					clase = 'alert-success';
					icono = '<i class="fa fa-check-circle"></i>';
					$(".cerrar-publicacion").css('display','none');
				}
				let alert = `<div class="alert ${clase} alert-chico" role="alert"> ${icono} ${respuesta.mensaje}</div>`;
				$('#cerrar-publicacion-respuesta').empty();
				$('#cerrar-publicacion-respuesta').append(alert);
			}
		});
	}
}

var map;
function initMap(){
	var lat = parseFloat(document.getElementById('lat').innerHTML);
	var lon = parseFloat(document.getElementById('lon').innerHTML);
	if(lat !== undefined && lon !== undefined){
		map = new google.maps.Map(document.getElementById('map'), {
		  center: {lat: lat, lng: lon},
		  zoom: 15
		});

		var marker = new google.maps.Marker({
		        position: new google.maps.LatLng(lat, lon),
		        map: map
	    });
	}
}



