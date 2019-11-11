<?php

	class RegistroModel extends baseModel{

		public function existeEmail($email){
			return $this->obtenerUsuarioPorEmail($email) !== FALSE;
		}

		public function existeEmailYPassword($email, $password){
			$cn = $this->getConexion();

			$cn->consulta(
				"SELECT * FROM usuarios WHERE email=:email AND password=:password",
				array(
					array("email", $email, 'string'),
					array("password", $password, 'string')
				)
			);
    		return $cn->cantidadRegistros() >= 1;
		}

		public function obtenerUsuarioPorEmail($email){
			$cn = $this->getConexion();

			$cn->consulta(
				"SELECT id,email,nombre FROM usuarios WHERE email = :email",
				array(
					array("email", $email, 'string')
				)
			);

			return $cn->siguienteRegistro();
		}

		public function insertarUsuario($nombreCompleto, $email, $password){
			$cn = $this->getConexion();

			$cn->consulta(
				"INSERT INTO usuarios(email, nombre, password) VALUES (:email,:nombre,:password)",
				array(
					array("email", $email, 'string'),
					array("nombre", $nombreCompleto, 'string'),
					array("password", $password, 'string')
				)
			);

			return !is_null($cn->ultimoIdInsert()); 
		}
	}
