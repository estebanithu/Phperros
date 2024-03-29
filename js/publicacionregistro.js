_pubreg={}
_pubreg.f={}
_pubreg.temp={}
_pubreg.servcom={}
_pubreg.servcom.f={}
_pubreg.googlemap={}
_pubreg.googlemap.f={}
_pubreg.googlemap.g={}

 _pubreg.googlemap.g.map=undefined;
 _pubreg.googlemap.g.marker=undefined;

$(document).ready(function(){
	_pubreg.f.initialize();
});

_pubreg.servcom.f.registrarPublicacion= function(publicacion,callback){

		$.ajax({
        type: "POST",
        url: "Publicacion/registro",
        data: publicacion,
        //contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (response) {
            callback(response)
        },
        failure: function (response) {
            callback()
        },
        error: function (response) {
            callback()
    	}
	});

}

_pubreg.f.initialize = function(){

	_pubreg.googlemap.f.initMap();
	$(document).on("click","#btn-registrar",_pubreg.f.registrarPublicacion);
	$(document).on("click","#close-error",function(){$("#container-error").addClass("oculto")});
	$(document).on("change","#select-especie",_pubreg.f.cambioEspecie);
	$(document).on("focus",".campo-error",function(){$(this).removeClass("campo-error")})
}

_pubreg.f.cambioEspecie = function(){

	var especieid = $("#select-especie").val();

	if(especieid!=-1){
		$("#select-raza option").removeClass("oculto");
		$("#select-raza option:not(*[data-especieid='"+especieid+"']):not(*[data-especieid='-1'])").addClass("oculto")
		$("#select-raza").val("-1")
	}

}

_pubreg.f.registrarPublicacion = function(callback){

	
	var error = _pubreg.f.validarForm();

	if(error==""){

		var titulo=$("#titulo").val();
		var descripcion=$("#descripcion").val();
		var tipo=$("#select-tipo").val();
		var especie=$("#select-especie").val();
		var raza=$("#select-raza").val();
		var barrio=$("#select-barrio").val();

		var publicacion = {
			titulo:titulo,
			descripcion:descripcion,
			tipo:tipo,
			especie:especie,
			raza:raza,
			barrio:barrio
		}

		if(_pubreg.googlemap.g.marker){
			publicacion.latitud= _pubreg.googlemap.g.marker.position.lat();
			publicacion.longitud= _pubreg.googlemap.g.marker.position.lng();
		}

		_pubreg.servcom.f.registrarPublicacion(publicacion,_pubreg.f.registrarPublicacionCompletado)

	}
	else{
		$("#error").html(error);
		$("#container-error").removeClass("oculto")
	}
}

_pubreg.f.validarForm = function(){

	$("#container-error").addClass("oculto")
	$(".campo-error").removeClass("campo-error")
	var error="";

	var titulofield=$("#titulo");
	var descripcionfield=$("#descripcion");
	var tipofield=$("#select-tipo");
	var especiefield=$("#select-especie");
	var razafield=$("#select-raza");
	var barriofield=$("#select-barrio");
	var filaimagenes = $("#tabla-imagenes tr");

	var camposconerror=[];

	if(titulofield.val().trim()==""){
		error+="Ingrese titulo<br>";
		camposconerror.push(titulofield)
	}

	if(descripcionfield.val().trim()==""){
		error+="Ingrese descripcion<br>";
		camposconerror.push(descripcionfield)
	}
	if(tipofield.val()=="-1"){
		error+="Seleccione tipo<br>";
		camposconerror.push(tipofield)
	}
	if(especiefield.val()=="-1"){
		error+="Seleccione especie<br>";
		camposconerror.push(especiefield)
	}
	if(razafield.val()=="-1"){
		error+="Seleccione raza<br>";
		camposconerror.push(razafield)
	}
	if(barriofield.val()=="-1"){
		error+="Seleccione barrio<br>";
		camposconerror.push(barriofield)
	}

	if(filaimagenes.length==0){
		error+="Agregue al menos una imagen<br>";
	}

	$.each(camposconerror,function(i,campo){
		campo.addClass("campo-error")
	})

	return error;
}

_pubreg.f.registrarPublicacionCompletado = function(response){

	if(response){
		_pubreg.temp.idpublicacion=response.id;
		//agrego input para enviar idpublicacion en el post del form
		var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "idpublicacion").val(_pubreg.temp.idpublicacion);
		 $('#upload-all-images').append($(input));

		 //cuando se suben las imagenes, se borras las filas y se agregan
		 //nuevas...esto lo hace el plugin en algun js. Una vez que se hayan recargado todas las filas
		 //significa que las imagenes fueron subidas
		 //NO ES LA MEJOR MANERA, ES QUE USANDO ESTA LIBRERIA
		 //NO LOGRAMOS LOCALIZAR EN QUE LUGAR SE ENGANCHA AL EVENTO DONE DEL SUBMIT DEL FORMULARIO
		 var cantidadimagenes=$("#tabla-imagenes tbody tr").toArray().length;
		 $("#tabla-imagenes tbody tr").bind('DOMSubtreeModified',function(){
		      if(--cantidadimagenes==0){
		      			$("#modal-registro-publicacion").modal({backdrop: 'static', keyboard: false})  
		      }
		  });

		 $("#upload-all-images").click();
	}
	else{
		alert("Se produjo un error inesperado, comuniquese con el administrador")
	}

}

 //ejemplo https://developers.google.com/maps/documentation/javascript/examples/marker-remove?hl=es-419


 _pubreg.googlemap.f.initMap = function() {
    var pos={lat: -34.8859834,
      		 lng: -56.1336387}

     _pubreg.googlemap.g.map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: pos
    });

     _pubreg.googlemap.g.map.addListener('click', function(event) {
      _pubreg.googlemap.f.addMarker(event.latLng);
    });
    // Adds a marker at the center of the map.
    //addMarker(pos);
  }

  // Adds a marker to the map and push to the array.
  _pubreg.googlemap.f.addMarker =function (location) {
  	google.maps.event.clearListeners(_pubreg.googlemap.g.map, 'click');
     _pubreg.googlemap.g.marker = new google.maps.Marker({
      position: location,
      animation: google.maps.Animation.DROP,
      draggable: true,
      map: _pubreg.googlemap.g.map
    });
  }


