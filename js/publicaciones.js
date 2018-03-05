
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


$(document).ready(function(){
	_pub.f.initialize();
});

_pub.servcom.f.realizarBusquedaConFiltros = function(filtro,callback){
    var jsondata = {busqueda:filtro["BUSQUEDA"],
					encontradoperdido:filtro["ENCONTRADOPERDIDO"],
					especies:filtro["ESPECIE"],
					razas:filtro["RAZA"],
					barrios:filtro["BARRIO"]};
    jsondata = JSON.stringify(jsondata);
    $.ajax({
        type: "POST",
        url: "Publicacion/obtenertodas",
        data: jsondata,
        contentType: "application/json; charset=utf-8",
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
	$(document).on("click","#filtros-barrios li",function(){_pub.f.aplicarFiltro($(this),"BARRIO")})
}

_pub.f.aplicarFiltro = function(elem,type){
	var id=elem.data("id");
	var indexOf = _pub.g.filtrosaplicados[type].indexOf(id);
	var aplicarFiltro = indexOf==-1;
	if(aplicarFiltro)
		_pub.g.filtrosaplicados[type].push(id);
	else
		_pub.g.filtrosaplicados[type].splice(indexOf,1);

	_pub.f.aplicarEstiloFiltro(elem,aplicarFiltro);
	_pub.f.filtrar();
}

_pub.f.aplicarEstiloFiltro = function(elem,seleccionar){
	if(seleccionar)
		elem.addClass("filtro-seleccionado")
	else
		elem.removeClass("filtro-seleccionado")
}

_pub.f.filtrar = function(){

	_pub.g.filtrosaplicados["BUSQUEDA"]=$("#search-input").val();
	_pub.g.filtrosaplicados["ENCONTRADOPERDIDO"]=$('input[name=encontradosperdidos]:checked').val();

	_pub.servcom.f.realizarBusquedaConFiltros(_pub.g.filtrosaplicados,_pub.f.busquedaConFiltrosCompletada);
}

_pub.f.busquedaConFiltrosCompletada = function(publicaciones){
		var divpublicaciones = $("#container-publicaciones");
		divpublicaciones.html(publicaciones)
}
