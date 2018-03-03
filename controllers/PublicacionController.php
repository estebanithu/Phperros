<?php

	class PublicacionController extends BaseController{

		public function __construct(){
			parent::__construct();
		}

		public function index(){
			$this->miSmarty->display('masterPage.tpl');
		}

		public function ver($id){
			var_dump($id);die();
		}

		public function vertodas(){

			if($_GET && isset($_GET['busqueda'])){

			}			
			$this->miSmarty->display('publicaciones.tpl');
			
		}

	}