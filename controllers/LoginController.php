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

		public function index(){
			$this->miSmarty->display('login/index.tpl');
		}

		public function login(){
			if(isset($_POST['email']) && isset($_POST['password'])){
				$email = $_POST['email'];
				$password = $_POST['password'];
				if($this->registroModel->existeEmailYPassword($email, $password)){
					$this->setearDatosUsuarioEnSession($email);
					$this->redirigir('Index');
				}else{
					$this->miSmarty->assign("error", 'Usuario/Password Incorrectos');
					$this->miSmarty->display('login/index.tpl');

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