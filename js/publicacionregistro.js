_pubreg={}
_pubreg.f={}
_pubreg.servcom={}
_pubreg.servcom.f={}

$(document).ready(function(){
	_pubreg.f.initialize();
});

_pubreg.servcom.f.registrarPublicacion= function(publicacion,callback){
		console.log(publicacion);
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
_pubreg.servcom.f.agregarImagenAPublicacion= function(idpublicacion,imagen,callback){

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

	//if(filaimagenes.length==0){
	//	error+="Agregue al menos una imagen<br>";
	//}

	$.each(camposconerror,function(i,campo){
		campo.addClass("campo-error")
	})

	return error;
}

_pubreg.f.registrarPublicacionCompletado = function(response){
		console.log(response)
		/*var canvas = $("canvas")[1];
		if (canvas.toBlob) {
		    canvas.toBlob(
		        function (blob) {
		            console.log(blob)

		        }
		        //,
		        //'image/jpeg'
		    );
		}*/
}

_pubreg.f.agregarImagenAPublicacionCompletado = function(){

}
