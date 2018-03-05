<?php

	 class PublicacionFiltro{

		public $abiertas=1;//0 TODAS, 1 ABIERTAS, 2 CERRADAS
		public $busqueda=""; 
		public $encontradoperdido=0;//0 TODOS, 1 ENCONTRADOS, 2 PERDIDOS
		public $especies=[];
		public $razas=[];
		public $barrios=[];
    	public $page=0; 
    	public $cant=10;

    	public function toSQL(){

    		$sqlfilters= [];

    		$abiertassql = $this->abiertas==1?"abierto=1":($this->abiertas==2?"abierto=0":"");
    		//TODO: mejorar esta
    		$busquedasql = !$this->IsNullOrEmptyString($this->busqueda)?"titulo LIKE '%".$this->busqueda."%'":"";
    		$encontradoperdidosql = $this->encontradoperdido==1?"tipo='E'":($this->encontradoperdido==2?"tipo='P'":"");
    		$especiessql = count($this->especies)>0?"especie_id in (".implode (", ", $this->especies).")":"";
    		$razassql = count($this->razas)>0?"raza_id in (".implode (", ", $this->razas).")":"";
    		$barriossql = count($this->barrios)>0?"barrio_id in (".implode (", ", $this->barrios).")":"";


    		if($abiertassql!="")
    			array_push($sqlfilters,$abiertassql);
    		if($busquedasql!="")
    			array_push($sqlfilters,$busquedasql);
    		if($encontradoperdidosql!="")
    			array_push($sqlfilters,$encontradoperdidosql);
    		if($especiessql!="")
    			array_push($sqlfilters,$especiessql);
    		if($razassql!="")
    			array_push($sqlfilters,$razassql);
    		if($barriossql!="")
    			array_push($sqlfilters,$barriossql);

    		if(count($sqlfilters)>0)
    			return implode(" AND ",$sqlfilters);
    		else
				return "1=1";
    	}

    	//TODO: pasarla a helper
    	private function IsNullOrEmptyString($question){
    			return (!isset($question) || trim($question)==='');
		}

	}