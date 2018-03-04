<?php

	class RegistroController extends BaseController{

		public function __construct(){
			parent::__construct();
			require_once 'models/RegistroModel.php';
			$this->registroModel = new RegistroModel();
		}

		public function index($codError=NULL){
			if(!is_null($codError)){
				$error = $this->obtenerMensajeDeError($codError);
				$this->miSmarty->assign("error", $error);
			}
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
					}else{
						$this->redirigir('Registro','index',1);

					}
				}
			}
		}

		private function existeEmail($email){
			return $this->registroModel->existeEmail($email);
		}

		private function obtenerMensajeDeError($codError){
			if($codError == 1){
				return 'El Email ingresado ya existe';
			}
		}

	}