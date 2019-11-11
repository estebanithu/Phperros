<?php

	class baseModel{

		public function __construct(){
			require_once 'libs/ConexionBD.php';
		}

		public function getConexion() {
		    $cn = new ConexionBD(
		            $_SERVER['BD_MOTOR'], $_SERVER['BD_SERVIDOR'], $_SERVER['BD_NOMBRE'], $_SERVER['BD_USUARIO'], $_SERVER['BD_PASSWORD']);

		    $cn->conectar();
		    return $cn;
		}

	}

?>
