<?php

	class PublicacionController extends BaseController{

		private $root_images="uploads/";

		public function __construct(){
			parent::__construct();
			require_once 'models/PublicacionesModel.php';
			require_once 'models/RazaModel.php';
			require_once 'models/EspecieModel.php';
			require_once 'models/BarrioModel.php';
			require_once 'models/PublicacionFiltro.php';
			require_once 'models/Publicacion.php';
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
				$publicacion = $this->obtenerPublicacion($_POST);
				//echo json_encode(array('prueba'=>$publicacion->esValida()));
				if($publicacion->esValida()){
					$id = $this->publicacionesModel->registrarPublicacion($publicacion);
					mkdir($this->root_images.$id);
					echo json_encode(array('id' => $id));
				}
				else{
					echo json_encode(array('error' =>"Se produjo un error"));
				}
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

		public function agregarImagen(){

			if($_POST){

				$nombreimagen = $_POST["nombreimagen"];
				$imagen = $_POST["imagen"];
				$idpublicacion = $_POST["idpublicacion"];

				$this->obtenerFile($imagen);
				$file_path =$this->root_images.$idpublicacion."/".$nombreimagen;
				if(!file_exists($file_path)){
					$file=$this->obtenerFile($imagen);
					file_put_contents($file_path,$file);
				}

				echo json_encode(array("success"=>"Imagen subida correctamente"));
			}
		}

		private function obtenerFile($imgEnBase64){
			if( strpos( $imgEnBase64,',') !== false ) {
				$base_to_php = explode(',', $imgEnBase64);
				$data = $base_to_php[1];
			}else{
				$data = $imgEnBase64;
			}
			$ret = base64_decode($data);
			return $ret;
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

		private function obtenerPublicacion($dic){

			$publicacion = new Publicacion();
			if($dic){
				if(isset($dic['titulo'])){
					$publicacion->titulo=$dic['titulo'];
				}
				if(isset($dic['descripcion'])){
					$publicacion->descripcion=$dic['descripcion'];
				}
				if(isset($dic['tipo'])){
					$publicacion->tipo=$dic['tipo'];
				}
				if(isset($dic['especie'])){
					$publicacion->especie=$dic['especie'];
				}
				if(isset($dic['raza'])){
					$publicacion->raza=$dic['raza'];
				}
				if(isset($dic['barrio'])){
					$publicacion->barrio=$dic['barrio'];
				}
			}
			return $publicacion;
		}


	}