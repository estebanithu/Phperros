<?php

	class RegistroModel extends baseModel{

		public function existeEmail($email){
			$cn = $this->getConexion();

			$cn->consulta(
				"SELECT * FROM usuarios WHERE email = :email",
				array(
					array("email", $email, 'string')
				)
			);
    		return $cn->cantidadRegistros() >= 1;
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
