<?php

	class PublicacionesModel extends baseModel{

		public function __construct(){
			require_once 'libs/ConexionBD.php';
			require_once 'models/PublicacionConsultaResultado.php';
		}
		
		public function obtenerPublicacionesHome() {
		    $cn = $this->getConexion();
		    $cn->consulta("SELECT * from publicaciones WHERE abierto = 1 ORDER BY id LIMIT 10");
		    return $cn->restantesRegistros();
		}

		public function obtenerPublicacionesConFiltro($filtro) {
		    $cn = $this->getConexion();
		    $consultaResultado = new PublicacionConsultaResultado();
		    $cn->consulta("SELECT * from publicaciones WHERE ".$filtro->toSQLSinPaginado());
		    $consultaResultado->cantTotal=$cn->cantidadRegistros();
		    $cn->consulta("SELECT * from publicaciones WHERE ".$filtro->toSQLConPaginado());
		    $consultaResultado->publicaciones = $cn->restantesRegistros();
		    return $consultaResultado;
		}

		public function registrarPublicacion($publicacion){
			$cn = $this->getConexion();
			$cn->consulta("INSERT INTO 'publicaciones' VALUES('".$publicacion->titulo."',"
						 		."'".$publicacion->descripcion."',"
								.$publicacion->tipo.","
								.$publicacion->especie.","
								.$publicacion->raza.","
								.$publicacion->barrio.","
								.$publicacion->abierto.","
								.$publicacion->usuario.","
								.$publicacion->exitoso.","
								.$publicacion->latitud.","
								.$publicacion->longitud.")");
		}
	}