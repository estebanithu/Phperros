<?php

	class PublicacionController extends BaseController{

		public function __construct(){
			parent::__construct();
			require_once 'models/PublicacionesModel.php';
			require_once 'models/PublicacionFiltro.php';
			$this->publicacionesModel = new PublicacionesModel();
		}

		public function index(){
			$this->miSmarty->display('masterPage.tpl');
		}

		public function ver($id){
			var_dump($id);die();
		}

		public function vertodas(){

			$filtro = $this->obtenerFiltro($_GET);
			$busqueda=$filtro->busqueda;
			$cantidad=count($this->publicacionesModel->obtenerPublicacionesConFiltro($filtro));

			$this->miSmarty->assign('cantidad',$cantidad);	
			$this->miSmarty->assign('busqueda',$busqueda);
			$this->miSmarty->display('publicacion/publicaciones.tpl');

			
		}

		private function obtenerFiltro($dic){
			$filtro = new PublicacionFiltro();
			if($dic){
				if(isset($dic['busqueda'])){
					$filtro->busqueda=$dic['busqueda'];
				}
			}
			return $filtro;
		}

	}