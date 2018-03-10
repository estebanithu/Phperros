_pubreg={}
_pubreg.f={}

$(document).ready(function(){
	_pubreg.f.initialize();
});

_pubreg.f.initialize = function(){

	$(document).on("click","#btn-registrar",_pubreg.f.registrarPublicacion);
	$(document).on("click","#close-error",function(){$("#container-error").addClass("oculto")});
	
}

_pubreg.f.registrarPublicacion = function(){

	$("#container-error").addClass("oculto")
	var error = _pubreg.f.validarForm();

	if(error==""){

	}
	else{
		$("#error").html(error);
		$("#container-error").removeClass("oculto")
	}
}

_pubreg.f.validarForm = function(){

	var error="";

	if($("#titulo").val().trim()=="")
		error+="Ingrese titulo<br>";
	if($("#descripcion").val().trim()=="")
		error+="Ingrese descripcion<br>";
	if($("#select-tipo").val()=="-1")
		error+="Seleccione tipo<br>";
	if($("#select-especie").val()=="-1")
		error+="Seleccione especie<br>";
	if($("#select-raza").val()=="-1")
		error+="Seleccione raza<br>";
	if($("#select-barrio").val()=="-1")
		error+="Seleccione barrio<br>";

	return error;
}