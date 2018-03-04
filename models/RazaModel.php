<?php
	
	class RazaModel extends baseModel{
		
		public function obtenerRazas() {
		    $cn = $this->getConexion();
		    $cn->consulta("SELECT * from razas");
		    return $cn->restantesRegistros();
		}

		
	}