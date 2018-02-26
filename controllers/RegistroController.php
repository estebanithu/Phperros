<?php

	class RegistroController extends BaseController{

		public function __construct(){
			parent::__construct();
			require_once 'models/RegistroModel.php';
			$this->registroModel = new RegistroModel();
		}

		public function index(){
			$this->miSmarty->display('registro/index.tpl');
		}

		public function registro(){
			if($_POST){
				if(isset($_POST['nombre-completo']) && isset($_POST['email']) && isset($_POST['password'])){
					$nombreCompleto = $_POST['nombre-completo'];
					$email = $_POST['email'];
					$password = $_POST['password'];
					if(!$this->existeEmail($email)){
						return $this->registroModel->insertarUsuario($nombreCompleto, $email, $password);
					}
				}
			}
		}

		private function existeEmail($email){
			return $this->registroModel->existeEmail($email);
		}

	}