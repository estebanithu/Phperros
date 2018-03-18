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

		public function obtenerPublicacionesUsuario($usuario_id) {
		    $cn = $this->getConexion();
		    $cn->consulta("SELECT id,titulo,IF(tipo = 'E','Encontrado','Perdido') as tipo, IF(abierto = 1,'Abierta','Cerrada') as estado from publicaciones WHERE usuario_id = :usuario_id",
		    	array(
		    		array("usuario_id", intval($usuario_id), 'int')
		    	));
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

		public function obtenerPublicacion($id){
			$cn = $this->getConexion();

			$cn->consulta(
				   "SELECT p.*,IF(p.abierto = 1,1,0) as abierta, r.nombre as raza, e.nombre as especie, u.nombre as usr_nom, u.email as usr_email
					FROM publicaciones p  
					JOIN especies e ON p.especie_id = e.id 
					JOIN razas r ON p.raza_id = r.id 
					JOIN usuarios u ON p.usuario_id = u.id 
					WHERE p.id = :id",
				array(
					array("id", intval($id), 'int')
				)
			);

			return $cn->siguienteRegistro();
		}

		public function obtenerPregunta($idPregunta){
			$cn = $this->getConexion();

			$cn->consulta(
				   "SELECT pr.*, u.id as usuario_respuesta
					FROM preguntas pr
					JOIN publicaciones p ON pr.id_publicacion = p.id
					JOIN usuarios u ON p.usuario_id = u.id
					WHERE pr.id = :id",
				array(
					array("id", intval($idPregunta), 'int')
				)
			);

			return $cn->siguienteRegistro();
		}


		public function obtenerPreguntas($idPublicacion){
			$cn = $this->getConexion();

			$cn->consulta(
				   "SELECT p.*, u.nombre as nombre_usuario 
					FROM  preguntas p 
					JOIN usuarios u ON p.usuario_id = u.id
					WHERE  id_publicacion = :idPub",
				array(
					array("idPub", intval($idPublicacion), 'int')
				)
			);

			return $cn->restantesRegistros();
		}

		public function insertarPregunta($idPublicacion,$pregunta,$idUsuario){
			$cn = $this->getConexion();
			$cn->consulta(
				"INSERT INTO preguntas(id_publicacion, texto, usuario_id) VALUES (:idPublicacion,:pregunta,:idUsuario)",
				array(
					array("idPublicacion", intval($idPublicacion), 'int'),
					array("pregunta", $pregunta, 'string'),
					array("idUsuario", intval($idUsuario), 'int')
				)
			);

			return !is_null($cn->ultimoIdInsert());
		}


		public function responderPregunta($idPregunta,$respuesta){
			$cn = $this->getConexion();
			return $cn->consulta(
				"UPDATE preguntas SET respuesta=:respuesta WHERE id=:idPregunta",
				array(
					array("idPregunta", intval($idPregunta), 'int'),
					array("respuesta", $respuesta, 'string')
				)
			);
		}


		public function cerrarPublicacion($idPublicacion,$exito){
			$cn = $this->getConexion();
			return $cn->consulta(
				"UPDATE publicaciones SET exitoso = :exito, abierto = 0 WHERE id = :idPublicacion",
				array(
					array("exito", intval($exito), 'int'),
					array("idPublicacion", intval($idPublicacion), 'int')
				)
			);
		}

	}