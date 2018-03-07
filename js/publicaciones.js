
_pub={};
_pub.g={};//variables globales
_pub.f={};//funciones
_pub.faux={};//funciones auxiliares
_pub.servcom={};//comunicaciones con el servidor
_pub.servcom.f={};

_pub.g.filtrosaplicados = {
	"BUSQUEDA": "",
	"ENCONTRADOPERDIDO": 0,//0 TODOS, 1 ENCONTRADOS, 2 PERDIDOS
    "ESPECIE": [],
    "RAZA": [],
    "BARRIO": []
}
_pub.g.especiesseleccionadas=[];
_pub.g.razasseleccionadasporespecie={};


$(document).ready(function(){
	_pub.f.initialize();
});

_pub.servcom.f.realizarBusquedaConFiltros = function(filtro,callback){
    var jsondata = {busqueda:filtro["BUSQUEDA"],
					encontradoperdido:filtro["ENCONTRADOPERDIDO"],
					especies:filtro["ESPECIE"],
					razas:filtro["RAZA"],
					barrios:filtro["BARRIO"]};
	console.log(jsondata);
    //jsondata = JSON.stringify(jsondata);
    $.ajax({
        type: "POST",
        url: "Publicacion/obtenertodas",
        data: jsondata,
       // contentType: "application/json; charset=utf-8",
        dataType: "html",
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

_pub.f.initialize = function(){
	$(document).on("click","#filtros-especies li",function(){_pub.f.aplicarFiltro($(this),"ESPECIE")});
	$(document).on("click","#filtros-razas li",function(){_pub.f.aplicarFiltro($(this),"RAZA")})
	$(document).on("click","#filtros-barrios li",function(){_pub.f.aplicarFiltro($(this),"BARRIO")});
	$(document).on("keyup","#search-input",_pub.f.filtrar);
	$(document).on("change","input[name=encontradosperdidos]",_pub.f.filtrar);


	var buscador = $("#form_busqueda").html();
}

_pub.f.aplicarFiltro = function(elem,type){

	//aplico el filtro
	var id=elem.data("id");
	var indexOf = _pub.g.filtrosaplicados[type].indexOf(id);
	var aplicarFiltro = indexOf==-1;

	if(aplicarFiltro)
		_pub.g.filtrosaplicados[type].push(id);
	else
		_pub.g.filtrosaplicados[type].splice(indexOf,1);

	_pub.f.aplicarEstiloFiltro(elem,aplicarFiltro);

	//si es raza o si es especie hago unos manejos particulares
	var esEspecie = elem.data("tipo")=="especie";
	var esRaza = elem.data("tipo")=="raza";
	if(esEspecie){
		_pub.f.handleFiltroDeEspecie(id,aplicarFiltro)
	}
	else if(esRaza){
		var idespecie=elem.data("especieid");
		_pub.f.handleFiltroDeRaza (id,idespecie,aplicarFiltro)
	}

	//una vez todos los filtros puestos, se filtra contra el servidor
	_pub.f.filtrar();
}


_pub.f.aplicarEstiloFiltro = function(elem,seleccionar){
	if(seleccionar)
		elem.addClass("filtro-seleccionado")
	else
		elem.removeClass("filtro-seleccionado")
}


_pub.f.handleFiltroDeEspecie = function(idespecie,aplicarFiltro){
	if(aplicarFiltro)
			_pub.g.especiesseleccionadas.push(idespecie);
	else{
		var indexaeliminar=_pub.g.especiesseleccionadas.indexOf(idespecie);
		_pub.g.especiesseleccionadas.splice(indexaeliminar,1);
		delete _pub.g.razasseleccionadasporespecie[idespecie];
	}
	_pub.f.mostrarOcultarRazas()
}

_pub.f.handleFiltroDeRaza = function(idraza,idespecie,aplicarFiltro){
	
	if(aplicarFiltro){
		if(!_pub.g.razasseleccionadasporespecie[idespecie])
			_pub.g.razasseleccionadasporespecie[idespecie]=[]

		_pub.g.razasseleccionadasporespecie[idespecie].push(idraza);
	}
	else{
		var razasporespecie=_pub.g.razasseleccionadasporespecie[idespecie];
		var indexaeliminar=razasporespecie.indexOf(idraza);
		razasporespecie.splice(indexaeliminar,1);
	}
}

_pub.f.mostrarOcultarRazas = function(){

	if(_pub.g.especiesseleccionadas.length>0){

		//oculto y deselecciono todas las razas
		$("#filtros-razas li").addClass("oculto");
		_pub.f.aplicarEstiloFiltro($("#filtros-razas li"),false);

		$.each(_pub.g.especiesseleccionadas,function(i,idespecie){
			$("#filtros-razas li[data-especieid="+idespecie+"]").removeClass("oculto");

			//si la especie esta seleccionada, muestro todas las razas
			//y selecciono aquellas que ya estaban seleccionados
			if(_pub.g.razasseleccionadasporespecie[idespecie]){
				$.each(_pub.g.razasseleccionadasporespecie[idespecie],function(index,razaid){
					_pub.f.aplicarEstiloFiltro($("#filtros-razas li[data-id="+razaid+"]"),true);
				});
			}
		})

	}
	else{
		//muestro todas las razas y saco la seleccion
		$("#filtros-razas li").removeClass("oculto");
		_pub.f.aplicarEstiloFiltro($("#filtros-razas li"),false);
	}
}


_pub.f.filtrar = function(){

	//$("#filtros-especies .filtro-seleccionado").data("id") de todos los selecionados
	//$("#filtros-razas .filtro-seleccionado").data("id") de todos los selecionados
	//$("#filtros-barrios .filtro-seleccionado").data("id") de todos los selecionados

	_pub.g.filtrosaplicados["BUSQUEDA"]=$("#search-input").val();
	_pub.g.filtrosaplicados["ENCONTRADOPERDIDO"]=$('input[name=encontradosperdidos]:checked').val();

	_pub.servcom.f.realizarBusquedaConFiltros(_pub.g.filtrosaplicados,_pub.f.busquedaConFiltrosCompletada);
}

_pub.f.busquedaConFiltrosCompletada = function(publicaciones){
		var divpublicaciones = $("#container-publicaciones");
		divpublicaciones.html(publicaciones)
}
