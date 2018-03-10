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
			$publicacionesconsulta=$this->publicacionesModel->obtenerPublicacionesConFiltro($filtro);
			$publicaciones=$publicacionesconsulta->publicaciones;
			$cantidadTotalPublicaciones=$publicacionesconsulta->cantTotal;
			$cantidadPaginasDePublicaciones=$cantidadTotalPublicaciones/$filtro->cant;
			$paginaseleccionada=$filtro->page+1;
			$especies = $this->especiesModel->obtenerEspecies();
			$razas = $this->razasModel->obtenerRazas();
			$barrios = $this->barriosModel->obtenerBarrios();

			$this->miSmarty->assign('buscadorsinform',true);
			$this->miSmarty->assign('busqueda',$busqueda);
			$this->miSmarty->assign('publicaciones',$publicaciones);
			$this->miSmarty->assign('canttotalpublicaciones',$cantidadTotalPublicaciones);	
			$this->miSmarty->assign('cantpages',$cantidadPaginasDePublicaciones);
			$this->miSmarty->assign('paginaseleccionada',$paginaseleccionada);

			$this->miSmarty->assign('especies',$especies);
			$this->miSmarty->assign('razas',$razas);
			$this->miSmarty->assign('barrios',$barrios);

			$this->miSmarty->display('publicacion/publicacionespage.tpl');	
		}

		public function obtenertodas(){
			$filtro = $this->obtenerFiltro($_POST);
			$publicacionesconsulta=$this->publicacionesModel->obtenerPublicacionesConFiltro($filtro);
			$publicaciones=$publicacionesconsulta->publicaciones;
			$cantidadTotalPublicaciones=$publicacionesconsulta->cantTotal;
			$cantidadPaginasDePublicaciones=$filtro->cant>$cantidadTotalPublicaciones?
											1:$cantidadTotalPublicaciones/$filtro->cant;
			$paginaseleccionada=$filtro->page+1;

			$this->miSmarty->assign('publicaciones',$publicaciones);
			$this->miSmarty->assign('canttotalpublicaciones',$cantidadTotalPublicaciones);	
			$this->miSmarty->assign('cantpages',$cantidadPaginasDePublicaciones);
			$this->miSmarty->assign('paginaseleccionada',$paginaseleccionada);	

			echo $this->miSmarty->display('publicacion/publicacionesconpaginado.tpl');
		}

		public function registro(){

			if($_POST){

			}
			else{
				$especies = $this->especiesModel->obtenerEspecies();
				$razas = $this->razasModel->obtenerRazas();
				$barrios = $this->barriosModel->obtenerBarrios();
				$this->miSmarty->assign('especies',$especies);
				$this->miSmarty->assign('razas',$razas);
				$this->miSmarty->assign('barrios',$barrios);
				$this->miSmarty->display('publicacion/publicacionregistro.tpl');
			}

				
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
				if(isset($dic['page'])){
					$filtro->page=$dic['page'];
				}
				if(isset($dic['cant'])){
					$filtro->cant=$dic['cant'];
				}
			}
			return $filtro;
		}


	}