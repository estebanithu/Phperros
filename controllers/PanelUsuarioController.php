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
		}

		public function verEstadisticas(){
			$totalPublicaciones = $this->publicacionesModel->totalPublicaciones();
			$estadisticasPorEspecie = $this->publicacionesModel->obtenerPublicacionesPorEspecie();
			$totales = $this->obtenerTotales($estadisticasPorEspecie);
			$this->miSmarty->assign("totalPublicaciones", $totalPublicaciones);
			$this->miSmarty->assign("estadisticasPorEspecie", $estadisticasPorEspecie);
			$this->miSmarty->assign("totales", $totales);
			$this->miSmarty->display('panelUsuario/estadisticas.tpl');
		}

		private function obtenerTotales($estadisticasPorEspecie){
			$totales = array();
			$totales['abiertas'] = 0;
			$totales['cerradas'] = 0;
			$totales['exitosas'] = 0;
			$totales['fracasadas'] = 0;
			foreach ($estadisticasPorEspecie as $especie) {
				$totales['abiertas']+= $especie['abiertas'];
				$totales['cerradas']+= $especie['cerradas'];
				$totales['exitosas']+= $especie['exitosas'];
				$totales['fracasadas']+= $especie['fracasadas'];
			}
			return $totales;
		}

	

	}