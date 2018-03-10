<?php
	
	class EspecieModel extends baseModel{
		
		public function obtenerEspecies() {
		    $cn = $this->getConexion();
		    $cn->consulta("SELECT * from especies");
		    return $cn->restantesRegistros();
		}

		
	}