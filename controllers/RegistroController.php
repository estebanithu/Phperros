<?php

	class RegistroController extends BaseController{

		public function __construct(){
			parent::__construct();
			require_once 'models/RegistroModel.php';
			$this->registroModel = new RegistroModel();
		}

		public function index($msjFeedback=NULL){
			if(!is_null($msjFeedback)){
				$msj = $this->obtenerMensajeFeedback($msjFeedback);
				$this->miSmarty->assign("mensaje", $msj);
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
						if($this->esPasswordValido($password)){
							if($this->registroModel->insertarUsuario($nombreCompleto, $email, $password)){
								$this->redirigir('Registro','index',0);
							}else{
								$this->redirigir('Registro','index',-2);
							}
						}else{
							$this->redirigir('Registro','index',-3);
						}
					}else{
						$this->redirigir('Registro','index',-1);

					}
				}
			}
		}

		private function existeEmail($email){
			return $this->registroModel->existeEmail($email);
		}

		private function esPasswordValido($password){
			return (preg_match('/[A-Za-z]/', $password) && preg_match('/\d/', $password) == 1) && strlen($password) >= 8;
		}


		private function obtenerMensajeFeedback($codMensaje){
			$ret = array();
			switch ($codMensaje) {
				case -1:
					$ret['feedback'] = 'El Email ingresado ya existe';
					$ret['es_error'] = 1;
					break;
				case -2:
					$ret['feedback'] = 'Error al hacer el registro, inténte nuevamente';
					$ret['es_error'] = 1;
					break;
				case -3:
					$ret['feedback'] = 'La contraseña debe contener al menos 8 caracteres, una letra y un número';
					$ret['es_error'] = 1;
					break;	
				case 0:
					$ret['feedback'] = 'Te has registrado correctamente!';
					$ret['es_error'] = 0;
					break;
			}
			return $ret;
		}

	}