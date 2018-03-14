<?php
	
	class Publicacion{
		
		
		public $titulo;
		public $descripcion; 
		public $tipo;
		public $especie;
		public $razas;
		public $barrio;
		public $abierto='';//'';
		public $usuario=1;
		public $exitoso=NULL;
		public $latitud=-34.82296900;
		public $longitud=-56.20121800;

		public function esValida(){

			return 
			!IsNullOrEmptyString($this->titulo)
			&& !IsNullOrEmptyString($this->descripcion)
			&& !IsNullOrEmptyString($this->tipo) && ($this->tipo=="P" || $this->tipo=="E")
			&& !IsNullOrEmptyString($this->especie) && is_int($this->especie)
			&& !IsNullOrEmptyString($this->razas) && is_int($this->raza)
			&& !IsNullOrEmptyString($this->barrio) && is_int($this->barrio);

		}

		private function IsNullOrEmptyString($question){
    		return (!isset($question) || trim($question)==='');
		}
		
	}