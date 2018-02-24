<?php

	class IndexController{

		public function __construct(){
			require_once 'models/publicacionesModel.php';
			$this->publicacionesModel = new publicacionesModel();
		}

		public function index(){


			$miSmarty = getSmarty();
			$publicaciones = $this->obtenerPublicacionesHome();
			$miSmarty->assign("publicaciones", $publicaciones);
			$miSmarty->display('masterPage.tpl');
		}

		private function obtenerPublicacionesHome(){
			return $this->publicacionesModel->obtenerPublicacionesHome();
		}

	}