<?php

	class PublicacionesModel extends baseModel{

		public function obtenerPublicacionesHome() {
		    $cn = $this->getConexion();
		    $cn->consulta("SELECT * from publicaciones WHERE abierto = 1 ORDER BY id LIMIT 10");
		    return $cn->restantesRegistros();
		}

		public function obtenerPublicacion($id){
			$cn = $this->getConexion();

			$cn->consulta(
				   "SELECT p.*,r.nombre as raza, e.nombre as especie, u.nombre as usr_nom, u.email as usr_email
					FROM publicaciones p  
					JOIN especies e ON p.especie_id = e.id 
					JOIN razas r ON p.raza_id = r.id 
					JOIN usuarios u ON p.usuario_id = u.id 
					WHERE p.id = :id",
				array(
					array("id", $id, 'int')
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
					array("id", $idPregunta, 'int')
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
					array("idPub", $idPublicacion, 'int')
				)
			);

			return $cn->restantesRegistros();
		}

		public function insertarPregunta($idPublicacion,$pregunta,$idUsuario){
			$cn = $this->getConexion();
			$cn->consulta(
				"INSERT INTO preguntas(id_publicacion, texto, usuario_id) VALUES (:idPublicacion,:pregunta,:idUsuario)",
				array(
					array("idPublicacion", $idPublicacion, 'int'),
					array("pregunta", $pregunta, 'string'),
					array("idUsuario", $idUsuario, 'int')
				)
			);

			return !is_null($cn->ultimoIdInsert()); 
		}


		public function responderPregunta($idPregunta,$respuesta){
			$cn = $this->getConexion();
			$cn->consulta(
				"UPDATE preguntas SET respuesta=:respuesta WHERE id=:idPregunta",
				array(
					array("idPregunta", $idPregunta, 'int'),
					array("respuesta", $respuesta, 'string')
				)
			);

			return !is_null($cn->ultimoIdInsert()); 
		}

	}