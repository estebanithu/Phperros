
_pub={};
_pub.f={};
_pub.g={};
_pub.g.filtrosaplicados = {
	"BUSQUEDA": "",
	"ENCONTRADOPERDIDO": 0,//0 AMBOS, 1 ENCONTRADOS, 2 PERDIDOS
    "ESPECIE": -1,
    "RAZA": -1,
    "BARRIO": -1
}

$(document).ready(function(){
	_pub.f.initialize();
});

_pub.f.initialize = function(){
	$(document).on("click","#filtros-especies li",function(){_pub.f.aplicarFiltro($(this),"ESPECIE")});
	$(document).on("click","#filtros-razas li",function(){_pub.f.aplicarFiltro($(this),"RAZA")})
	$(document).on("click","#filtros-barrios li",function(){_pub.f.aplicarFiltro($(this),"BARRIO")})
}

_pub.f.aplicarFiltro = function(elem,type){
	_pub.g.filtrosaplicados[type]=elem.data("id");
}