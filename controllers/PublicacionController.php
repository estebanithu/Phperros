<?php

	class PublicacionController extends BaseController{

		public function __construct(){
			parent::__construct();
			require_once 'models/PublicacionesModel.php';
			$this->publicacionModel = new PublicacionesModel();
		}

		public function index(){
			$this->miSmarty->display('masterPage.tpl');
		}

		public function verDetalle($id){
			if(!is_null($id)){
				$publicacion = $this->publicacionModel->obtenerPublicacion($id);
				$imagenes = $this->obtenerImagenes($id);
				$preguntas = $this->publicacionModel->obtenerPreguntas($id);
				$this->miSmarty->assign("imagenes", $imagenes);
				$this->miSmarty->assign("publicacion", $publicacion);
				$this->miSmarty->assign("preguntas", $preguntas);
				$this->miSmarty->display('publicacion/publicacion-detalle.tpl');
			}
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
				if($this->publicacionModel->insertarPregunta($idPublicacion,$pregunta,$idUsuario)){
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
					if($this->publicacionModel->responderPregunta($idPregunta,$respuesta)){
						echo $this->armarHtmlRespuesta($respuesta);
					}
				}
			}
		}

		private function respondeUsuarioCorrespondiente($idPregunta){
			if(isset($_SESSION['usuarioLogueado'])){
				$pregunta = $this->publicacionModel->obtenerPregunta($idPregunta);
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
					if($this->publicacionModel->cerrarPublicacion($idPublicacion,$exito)){
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
				$publicacion = $this->publicacionModel->obtenerPublicacion($idPublicacion);
				return $publicacion['usuario_id'] == $_SESSION['usuarioLogueado']['id'];
			}
			return FALSE;
		}


	}