
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
    "BARRIO": [],
    "PAGE":0,
    "CANT":10
}
_pub.g.especiesseleccionadas=[];
_pub.g.razasseleccionadasporespecie={};
_pub.g.barriosseleccionados=[];


$(document).ready(function(){
	_pub.f.initialize();
});

_pub.servcom.f.realizarBusquedaConFiltros = function(filtro,callback){
    var jsondata = {busqueda:filtro["BUSQUEDA"],
					encontradoperdido:filtro["ENCONTRADOPERDIDO"],
					especies:filtro["ESPECIE"],
					razas:filtro["RAZA"],
					barrios:filtro["BARRIO"],
					page:filtro["PAGE"],
					cant:filtro["CANT"]};
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

	$(document).on("click","#filtros-especies li",function(){_pub.f.aplicarFiltroEspecie($(this))});
	$(document).on("click","#filtros-razas li",function(){_pub.f.aplicarFiltroRaza($(this))})
	$(document).on("click","#filtros-barrios li",function(){_pub.f.aplicarFiltroBarrio($(this))})
	$(document).on("keyup","#search-input",_pub.f.filtrar);
	$(document).on("change","input[name=encontradosperdidos]",_pub.f.filtrar);
	$(document).on("click",".pagination li.page-number",function(){_pub.f.aplicarPaginado($(this))});


	var buscador = $("#form_busqueda").html();
}

_pub.f.aplicarFiltroEspecie = function(elem){

	var id=elem.data("id");
	var indexOf = _pub.g.especiesseleccionadas.indexOf(id);
	var aplicarFiltro = indexOf==-1;

	_pub.f.aplicarEstiloFiltro(elem,aplicarFiltro);

	if(aplicarFiltro)
			_pub.g.especiesseleccionadas.push(id);
	else{
		var indexaeliminar=_pub.g.especiesseleccionadas.indexOf(id);
		_pub.g.especiesseleccionadas.splice(indexaeliminar,1);
		delete _pub.g.razasseleccionadasporespecie[id];
	}
	_pub.f.mostrarOcultarRazas()

	_pub.f.filtrar();

}

_pub.f.aplicarFiltroRaza = function(elem){

	var id=elem.data("id");
	var idespecie=elem.data("especieid");
	var indexOf=-1;
	if(_pub.g.razasseleccionadasporespecie[idespecie])
	 indexOf = _pub.g.razasseleccionadasporespecie[idespecie].indexOf(id);
	var aplicarFiltro = indexOf==-1;


	_pub.f.aplicarEstiloFiltro(elem,aplicarFiltro);	

	if(aplicarFiltro){
		if(!_pub.g.razasseleccionadasporespecie[idespecie])
			_pub.g.razasseleccionadasporespecie[idespecie]=[]

		_pub.g.razasseleccionadasporespecie[idespecie].push(id);
	}
	else{
		var razasporespecie=_pub.g.razasseleccionadasporespecie[idespecie];
		var indexaeliminar=razasporespecie.indexOf(id);
		razasporespecie.splice(indexaeliminar,1);
	}

	_pub.f.filtrar();

}

_pub.f.aplicarFiltroBarrio = function(elem){

	var id=elem.data("id");
	var indexOf = _pub.g.barriosseleccionados.indexOf(id);
	var aplicarFiltro = indexOf==-1;

	_pub.f.aplicarEstiloFiltro(elem,aplicarFiltro);

	if(aplicarFiltro)
		_pub.g.barriosseleccionados.push(id);
	else
		_pub.g.barriosseleccionados.splice(indexOf,1);

	_pub.f.filtrar();

}

_pub.f.aplicarEstiloFiltro = function(elem,seleccionar){
	if(seleccionar)
		elem.addClass("filtro-seleccionado")
	else
		elem.removeClass("filtro-seleccionado")
}

_pub.f.aplicarPaginado = function(elem){

	$(".pagination li.page-number").removeClass("active");
	elem.addClass("active");
	_pub.f.filtrar();
}

_pub.f.mostrarOcultarRazas = function(){

	if(_pub.g.especiesseleccionadas.length>0){

		//oculto y deselecciono todas las razas
		$("#filtros-razas li").addClass("oculto");
		_pub.f.aplicarEstiloFiltro($("#filtros-razas li"),false);

		//recorro las especies seleccionadas
		$.each(_pub.g.especiesseleccionadas,function(i,idespecie){
			//muestro todas sus razas
			$("#filtros-razas li[data-especieid="+idespecie+"]").removeClass("oculto");
		
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

	_pub.g.filtrosaplicados["ESPECIE"]=_pub.g.especiesseleccionadas;
	var razas=[];
	$.each(Object.keys(_pub.g.razasseleccionadasporespecie),function(i,idespecie){

			razas=razas.concat(_pub.g.razasseleccionadasporespecie[idespecie]);
	});
	_pub.g.filtrosaplicados["RAZA"]=razas;
	_pub.g.filtrosaplicados["BARRIO"]=_pub.g.barriosseleccionados;
	_pub.g.filtrosaplicados["BUSQUEDA"]=$("#search-input").val();
	_pub.g.filtrosaplicados["ENCONTRADOPERDIDO"]=$('input[name=encontradosperdidos]:checked').val();
	_pub.g.filtrosaplicados["PAGE"]=parseInt($(".pagination li.page-number.active span").html())-1;
	_pub.servcom.f.realizarBusquedaConFiltros(_pub.g.filtrosaplicados,_pub.f.busquedaConFiltrosCompletada);
}

_pub.f.busquedaConFiltrosCompletada = function(publicaciones){
		var divpublicaciones = $("#container-publicaciones");
		divpublicaciones.html(publicaciones)
}
