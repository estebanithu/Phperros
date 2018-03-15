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

		public function verDetalle($id){
			if(!is_null($id)){
				$publicacion = $this->publicacionesModel->obtenerPublicacion($id);
				$imagenes = $this->obtenerImagenes($id);
				$preguntas = $this->publicacionesModel->obtenerPreguntas($id);
				$this->miSmarty->assign("imagenes", $imagenes);
				$this->miSmarty->assign("publicacion", $publicacion);
				$this->miSmarty->assign("preguntas", $preguntas);
				$this->miSmarty->display('publicacion/publicacion-detalle.tpl');
			}
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

		private function obtenerImagenes($id){
			$dir = 'uploads/'.$id.'/';
			$imagenes = scandir($dir);
			$retorno = array();
			foreach ($imagenes as $img) {
				if($img != '.' && $img != '..'){
					array_push($retorno, $dir.$img);
				}
			}
			return $retorno;
		}

		public function realizarPregunta(){
			if(isset($_POST['pregunta']) && isset($_POST['idPublicacion']) && isset($_SESSION['usuarioLogueado'])){
				$idPublicacion = $_POST['idPublicacion'];
				$pregunta = $_POST['pregunta'];
				$idUsuario = $_SESSION['usuarioLogueado']['id'];
				if($this->publicacionesModel->insertarPregunta($idPublicacion,$pregunta,$idUsuario)){
					echo $this->armarHtmlPregunta($pregunta);
				}
			}
		}

		private function armarHtmlPregunta($pregunta){
			$ret = '<li class="pregunta-respuesta" style="list-style:  none; border-bottom: 1px solid rgba(0,0,0,.1); padding-bottom: 10px;padding-top: 10px;">
					<article class="pregunta" style="margin-bottom: 5px;"><i class="fa fa-comment"></i> '.$pregunta.'</article>
				</li>';
			return $ret;
		}

		public function responderPregunta(){
			if(isset($_POST['respuesta']) && isset($_POST['idPregunta'])){
				$respuesta = $_POST['respuesta'];
				$idPregunta = $_POST['idPregunta'];
				if($this->respondeUsuarioCorrespondiente($idPregunta)){
					if($this->publicacionesModel->responderPregunta($idPregunta,$respuesta)){
						echo $this->armarHtmlRespuesta($respuesta);
					}
				}
			}
		}

		private function respondeUsuarioCorrespondiente($idPregunta){
			if(isset($_SESSION['usuarioLogueado'])){
				$pregunta = $this->publicacionesModel->obtenerPregunta($idPregunta);
				return $pregunta['usuario_respuesta'] == $_SESSION['usuarioLogueado']['id'];
			}
			return FALSE;
		}

		private function armarHtmlRespuesta($respuesta){
			$ret = '<article class="respuesta" style="margin-left: 15px;"><i style="  -webkit-transform:rotateY(180deg);  -moz-transform:rotateY(180deg);  -o-transform:rotateY(180deg);  -ms-transform:rotateY(180deg);" class="fa fa-comment"></i> '.$respuesta.'</article>';
			return $ret;
		}

		public function cerrarPublicacion(){
			$retorno = array();
			$retorno['error'] = 1;
			if(isset($_POST['idPublicacion']) && isset($_POST['exito'])){
				$idPublicacion = $_POST['idPublicacion'];
				$exito = $_POST['exito'];
				if($this->cierraUsuarioCorrespondiente($idPublicacion)){
					if($this->publicacionesModel->cerrarPublicacion($idPublicacion,$exito)){
						$retorno['error'] = 0;
						$retorno['mensaje'] = 'La publicacion se ha cerrado correctamente';
					}
				}
			}
			if($retorno['error'] == 1){
				$retorno['mensaje'] = 'Error al cerrar la publicación';
			}
			echo json_encode($retorno);
		}

		private function cierraUsuarioCorrespondiente($idPublicacion){
			if(isset($_SESSION['usuarioLogueado'])){
				$publicacion = $this->publicacionesModel->obtenerPublicacion($idPublicacion);
				return $publicacion['usuario_id'] == $_SESSION['usuarioLogueado']['id'];
			}
			return FALSE;
		}

		public function generarPublicacionPDF($id){
			$publicacion = (object) $this->publicacionesModel->obtenerPublicacion($id);
			$fotosPublicacion = $this->obtenerImagenes($id);
			require_once 'services/GeneradorPDF.php';
			$generadorPDF = new GeneradorPDF();
			$generadorPDF->generarPublicacionEnPDF($publicacion, $fotosPublicacion);
		}
}