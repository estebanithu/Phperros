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
			$cn->consulta(
				"INSERT INTO publicaciones(titulo, descripcion, tipo, especie_id, raza_id, barrio_id, abierto, usuario_id, exitoso, latitud, longitud) VALUES (:titulo, :descripcion, :tipo, :especie_id, :raza_id, :barrio_id, :abierto, :usuario_id, :exitoso, :latitud, :longitud)",
				array(
					array("titulo", $publicacion->titulo, 'string'),
					array("descripcion", $publicacion->descripcion, 'string'),
					array("tipo", $publicacion->tipo, 'string'),
					array("especie_id", $publicacion->especie, 'int'),
					array("raza_id", $publicacion->raza, 'int'),
					array("barrio_id", $publicacion->barrio, 'int'),
					array("abierto", $publicacion->abierto, 'int'),
					array("usuario_id", $publicacion->usuario, 'int'),
					array("exitoso", $publicacion->exitoso, 'int'),
					array("latitud", $publicacion->latitud, 'string'),
					array("longitud", $publicacion->longitud, 'string'),
				)
			);

			return $cn->ultimoIdInsert(); 
		}

	}