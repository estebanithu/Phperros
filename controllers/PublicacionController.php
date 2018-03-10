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


	}