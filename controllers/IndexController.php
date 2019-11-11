<?php

	class IndexController extends BaseController{

		public function __construct(){
			parent::__construct();
			require_once 'models/PublicacionesModel.php';
			$this->publicacionesModel = new PublicacionesModel();
			$this->cantidadAnunciosHome = intval($_SERVER['SITIO_CANTIDAD_ANUNCIOS_HOME']);
		}

		public function index(){
			//var_dump($this->cantidadAnunciosHome);die();
			$publicaciones = $this->obtenerPublicacionesHome();
			foreach ($publicaciones as $key => $value) {
				//$publicaciones[$key]['img'] = 'uploads/'.$value['id'].'/1.jpg';
				$publicaciones[$key]['img'] = $this->obtenerPrimerImagenPublicacion($value['id']);
			}
			$this->miSmarty->assign("publicaciones", $publicaciones);
			$this->miSmarty->display('masterPage.tpl');
		}

		private function obtenerPublicacionesHome(){
			$publicaciones = $this->publicacionesModel->obtenerPublicacionesHome($this->cantidadAnunciosHome);
			foreach ($publicaciones as $i => $value) {
				$publicaciones[$i]['descripcion'] = $this->recortarDescripcion($publicaciones[$i]['descripcion'] , 150);
			}
			return $publicaciones;
		}
	}