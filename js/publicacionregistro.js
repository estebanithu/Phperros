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
	$(".campo-error").removeClass("campo-error")

	var titulofield=$("#titulo");
	var descripcionfield=$("#descripcion");
	var tipofield=$("#select-tipo");
	var especiefield=$("#select-especie");
	var razafield=$("#select-raza");
	var barriofield=$("#select-barrio");

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

	$.each(camposconerror,function(i,campo){
		campo.addClass("campo-error")
	})

	return error;
}