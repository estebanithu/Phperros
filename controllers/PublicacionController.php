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

	}