<?php

	class PublicacionController extends BaseController{

		public function __construct(){
			parent::__construct();
			require_once 'models/PublicacionesModel.php';
			require_once 'models/RazaModel.php';
			require_once 'models/EspecieModel.php';
			require_once 'models/BarrioModel.php';
			require_once 'models/PublicacionFiltro.php';
			$this->publicacionesModel = new PublicacionesModel();
			$this->especiesModel = new EspecieModel();
			$this->razasModel = new RazaModel();
			$this->barriosModel = new BarrioModel();
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
			$publicaciones=$this->publicacionesModel->obtenerPublicacionesConFiltro($filtro);
			$especies = $this->especiesModel->obtenerEspecies();
			$razas = $this->razasModel->obtenerRazas();
			$barrios = $this->barriosModel->obtenerBarrios();

			$this->miSmarty->assign('busqueda',$busqueda);
			$this->miSmarty->assign('publicaciones',$publicaciones);	
			$this->miSmarty->assign('especies',$especies);
			$this->miSmarty->assign('razas',$razas);
			$this->miSmarty->assign('barrios',$barrios);
			$this->miSmarty->display('publicacion/publicacionespage.tpl');	
		}

		public function obtenertodas(){

			$filtro = $this->obtenerFiltro($_POST);
			$publicaciones=$this->publicacionesModel->obtenerPublicacionesConFiltro($filtro);
			$this->miSmarty->assign('publicaciones',$publicaciones);	
			echo $this->miSmarty->display('publicacion/publicaciones.tpl');//json_encode($publicaciones);
		}

		private function obtenerFiltro($dic){

			$filtro = new PublicacionFiltro();
			if($dic){
				if(isset($dic['busqueda'])){
					$filtro->busqueda=$dic['busqueda'];
				}
				if(isset($dic['encontradoperdido'])){
					$filtro->encontradoperdido=$dic['encontradoperdido'];
				}
				if(isset($dic['especies'])){
					$filtro->especies=$dic['especies'];
				}
				if(isset($dic['razas'])){
					$filtro->razas=$dic['razas'];
				}
				if(isset($dic['barrios'])){
					$filtro->barrios=$dic['barrios'];
				}
			}
			return $filtro;
		}

	}