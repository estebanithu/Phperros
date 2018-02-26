<?php
	
	class BaseController{

		protected $miSmarty;
		
		public function __construct(){
			$this->miSmarty = getSmarty();
		}

	}