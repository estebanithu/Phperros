<?php

	class publicacionesModel extends baseModel{

		public function obtenerPublicacionesHome() {
		    $cn = $this->getConexion();
		    $cn->consulta("SELECT * from publicaciones");
		    return $cn->restantesRegistros();
		}

	}