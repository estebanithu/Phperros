<?php

	class baseModel{

		public function __construct(){
			require_once 'libs/ConexionBD.php';
		}

		public function getConexion() {
		    $cn = new ConexionBD(
		            "mysql", "localhost", "mascotas", "root", "root");

		    $cn->conectar();
		    return $cn;
		}

	}

?>
