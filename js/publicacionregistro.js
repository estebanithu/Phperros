_pubreg={}
_pubreg.f={}
_pubreg.temp={}
_pubreg.servcom={}
_pubreg.servcom.f={}

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
            callback(response)
        },
        error: function (response) {
            callback(response)
    	}
	});

}
_pubreg.servcom.f.agregarImagenAPublicacion= function(idpublicacion,base64image,nombreimagen,callback){

	console.log("VA A AGREGAR IMAGEN")
	var fd = new FormData();
	fd.append('nombreimagen', nombreimagen);
	fd.append('imagen', base64image);
	fd.append('idpublicacion', idpublicacion);
	$.ajax({
	    type: 'POST',
	    url: 'Publicacion/agregarImagen',
	    data: fd,
	    processData: false,
	    contentType: false
	}).done(function(data) {
			console.log(data);
	       _pubreg.f.agregarImagenAPublicacionCompletado();
	});
}

_pubreg.f.initialize = function(){

	$(document).on("click","#btn-registrar",_pubreg.f.registrarPublicacion);
	$(document).on("click","#close-error",function(){$("#container-error").addClass("oculto")});
	$(document).on("change","#select-especie",_pubreg.f.cambioEspecie);
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
		console.log(response.id);
		_pubreg.temp.idpublicacion=response.id;
		_pubreg.temp.imagenesCanvasParaEnviar=$("canvas").toArray();
		_pubreg.f.agregarImagenAPublicacion();
}

_pubreg.f.agregarImagenAPublicacion=function(){

	if(_pubreg.temp.imagenesCanvasParaEnviar.length>0){
			var imgCanvas = _pubreg.temp.imagenesCanvasParaEnviar.shift();//remueve el primero y lo devuelve
			if (imgCanvas.toBlob) {
	    		imgCanvas.toBlob(
			        function (blob) {
			            
			            var reader = new FileReader();
							reader.readAsDataURL(blob); 
							reader.onloadend = function() {
	 							base64data = reader.result;                
	 							_pubreg.servcom.f.agregarImagenAPublicacion(_pubreg.temp.idpublicacion,base64data,"nombreimagen",_pubreg.f.agregarImagenAPublicacionCompletado);
			        
							}
			        }
	    		);
			}	
		}		
}

_pubreg.f.agregarImagenAPublicacionCompletado = function(response){
	_pubreg.f.agregarImagenAPublicacion(_pubreg.temp.idpublicacion);
}
