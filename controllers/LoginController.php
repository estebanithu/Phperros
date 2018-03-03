<?php

	class LoginController extends BaseController{

		public function __construct(){
			parent::__construct();
			if($this->estaLogueado()){
				$this->redirigirAHome();
			}
			require_once('models/RegistroModel.php');
			$this->registroModel = new RegistroModel();
		}

		public function index($codError=NULL){
			if(!is_null($codError)){
				$error = $this->obtenerMensajeDeError($codError);
				$this->miSmarty->assign("error", $error);
			}
			$this->miSmarty->display('login/index.tpl');
		}

		private function obtenerMensajeDeError($codError){
			if($codError == 1){
				return 'Usuario/Password Incorrectos';
			}
		}

		public function login(){
			if(isset($_POST['email']) && isset($_POST['password'])){
				$email = $_POST['email'];
				$password = $_POST['password'];
				if($this->registroModel->existeEmailYPassword($email, $password)){
					$this->setearDatosUsuarioEnSession($email);
					$this->redirigir('Index');
				}else{			
					$this->redirigir('Login','index',1);
				}
			}
		}

		private function setearDatosUsuarioEnSession($email){
			$datosUsuario = $this->registroModel->obtenerUsuarioPorEmail($email);
			foreach ($datosUsuario as $key => $value) {
				$_SESSION['usuarioLogueado'][$key] = $value;
			}
		}

		public function logout(){
			if(isset($_SESSION)){
				session_destroy();
				$this->redirigir('Index');
			}
		}

	}