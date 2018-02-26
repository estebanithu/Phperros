<?php

	class IndexController extends BaseController{

		public function __construct(){
			parent::__construct();
			require_once 'models/PublicacionesModel.php';
			$this->publicacionesModel = new PublicacionesModel();
		}

		public function index(){
			$publicaciones = $this->obtenerPublicacionesHome();
			$this->miSmarty->assign("publicaciones", $publicaciones);
			$this->miSmarty->display('masterPage.tpl');
		}

		private function obtenerPublicacionesHome(){
			$publicaciones = $this->publicacionesModel->obtenerPublicacionesHome();
			foreach ($publicaciones as $i => $value) {
				$publicaciones[$i]['descripcion'] = $this->recortarDescripcion($publicaciones[$i]['descripcion'] , 150);
			}
			return $publicaciones;
		}

		private function recortarDescripcion($descripcion, $cantidadCaracteres){
			$largoDescripcion = strlen($descripcion);
			if($largoDescripcion < 150){
				return $descripcion;
			}
			$recorte = substr($descripcion, 0, 150);
			$recorte.='...';
			return $recorte;
		}

	}