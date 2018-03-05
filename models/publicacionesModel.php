<?php

	class PublicacionesModel extends baseModel{
		
		public function obtenerPublicacionesHome() {
		    $cn = $this->getConexion();
		    $cn->consulta("SELECT * from publicaciones WHERE abierto = 1 ORDER BY id LIMIT 10");
		    return $cn->restantesRegistros();
		}

		public function obtenerPublicacionesConFiltro($filtro) {
		    $cn = $this->getConexion();
		    $cn->consulta("SELECT * from publicaciones WHERE ".$filtro->toSQL());
		    return $cn->restantesRegistros();
		    /*if($cn->cantidadRegistros()>0)
		    	return $cn->restantesRegistros();
		    else
		    	return [];*/
		}
	}