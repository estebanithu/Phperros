<?php
	
	class Publicacion{
		
		
		public $titulo;
		public $descripcion; 
		public $tipo;
		public $especie;
		public $raza;
		public $barrio;
		public $abierto=1;
		public $usuario;
		public $exitoso=NULL;
		public $latitud=NULL;
		public $longitud=NULL;

		public function esValida(){
			return 
			!$this->IsNullOrEmptyString($this->titulo)
			&& !$this->IsNullOrEmptyString($this->descripcion)
			&& !$this->IsNullOrEmptyString($this->tipo) && ($this->tipo=="P" || $this->tipo=="E")
			&& !$this->IsNullOrEmptyString($this->especie) && is_numeric($this->especie)
			&& !$this->IsNullOrEmptyString($this->raza) && is_numeric($this->raza)
			&& !$this->IsNullOrEmptyString($this->barrio) && is_numeric($this->barrio)
			;

		}

		private function IsNullOrEmptyString($question){
    		return (!isset($question) || trim($question)==='');
		}
		
	}