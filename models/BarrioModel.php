<?php
	
	class BarrioModel extends baseModel{
		
		public function obtenerBarrios() {
		    $cn = $this->getConexion();
		    $cn->consulta("SELECT * from barrios");
		    return $cn->restantesRegistros();
		}

		
	}