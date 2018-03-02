<?php
	
	class BaseController{

		protected $miSmarty;
		protected $usuarioLogueado;
		private $home;
		
		public function __construct(){
			if (session_status() == PHP_SESSION_NONE) {
			    session_start();
			}
			$this->home = 'https://192.168.56.101/Phperros/';
			$this->miSmarty = getSmarty();
			$hayUsuarioLogueado = $this->estaLogueado();

			if($hayUsuarioLogueado){
				$this->usuarioLogueado = $_SESSION['usuarioLogueado'];
				$this->miSmarty->assign('usuarioLogueado', $this->usuarioLogueado);
			}

			$this->miSmarty->assign('hayUsuarioLogueado', $hayUsuarioLogueado);
		}


		protected function estaLogueado(){
			return isset($_SESSION['usuarioLogueado']);
		}

		protected function redirigir($controller,$action=NULL){
			$url = !is_null($action) ? $this->home.$controller.$action : $this->home.$controller;
			header("Location: ".$url);
		}





	}