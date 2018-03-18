<?php

	class PanelUsuarioController extends BaseController{

		public function __construct(){
			parent::__construct();
			$this->restringirALogueados();
			require_once 'models/PublicacionesModel.php';
			$this->publicacionesModel = new PublicacionesModel();
		}

		public function index(){
			$idUsuario = $_SESSION['usuarioLogueado']['id'];
			$publicacionesUsuario = $this->publicacionesModel->obtenerPublicacionesUsuario($idUsuario);
			$tienePublicaciones = count($publicacionesUsuario) > 0;
			$this->miSmarty->assign("tienePublicaciones", $tienePublicaciones);
			$this->miSmarty->assign("publicaciones", $publicacionesUsuario);
			$this->miSmarty->display('panelUsuario/index.tpl');
			//var_dump($publicacionesUsuario);die();

			/*$publicaciones = $this->obtenerPublicacionesHome();
			foreach ($publicaciones as $key => $value) {
				//$publicaciones[$key]['img'] = 'uploads/'.$value['id'].'/1.jpg';
				$publicaciones[$key]['img'] = $this->obtenerPrimerImagenPublicacion($value['id']);
			}
			$this->miSmarty->assign("publicaciones", $publicaciones);
			$this->miSmarty->display('masterPage.tpl');*/
		}

	

	}