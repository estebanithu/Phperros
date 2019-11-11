<?php
	
	class BaseController{

		protected $miSmarty;
		protected $usuarioLogueado;
		private $home;
		
		public function __construct(){
			if (session_status() == PHP_SESSION_NONE) {
			    session_start();
			}
			$this->asignarVariablesConfig();
			
			
			$hayUsuarioLogueado = $this->estaLogueado();

			if($hayUsuarioLogueado){
				$this->usuarioLogueado = $_SESSION['usuarioLogueado'];
				$this->miSmarty->assign('usuarioLogueado', $this->usuarioLogueado);
			}

			$this->miSmarty->assign('hayUsuarioLogueado', $hayUsuarioLogueado);
		}

		private function asignarVariablesConfig(){
			$this->miSmarty = getSmarty();
			$this->home = $_SERVER['SITIO_URL'];
			$this->miSmarty->assign('baseUrl', $_SERVER['BASE_HEADER']);
			$this->miSmarty->assign('nombreSitio', $_SERVER['SITIO_NOMBRE']);
			$this->miSmarty->assign('autorSitio', $_SERVER['SITIO_AUTOR']);
			$this->miSmarty->assign('descripcionSitio', $_SERVER['SITIO_DESCRIPCION']);
			$this->miSmarty->assign('cantidadAnunciosHome', $_SERVER['SITIO_CANTIDAD_ANUNCIOS_HOME']);
		}


		protected function estaLogueado(){
			return isset($_SESSION['usuarioLogueado']);
		}

		protected function restringirALogueados(){
			if(!$this->estaLogueado())
				$this->redirigir('Index');
		}

		protected function redirigir($controller,$action=NULL,$parameter=NULL){
			$url = !is_null($action) ? $this->home.$controller.'/'.$action : $this->home.$controller;
			$url = !is_null($parameter) ? $url.'/'.$parameter: $url;
			header("Location: ".$url);
		}

		//ESTAS DE AQUI ABAJO PODRIAN LLEVARSE A UN HELPER
		protected function obtenerPrimerImagenPublicacion($id){
			$dir = 'uploads/'.$id.'/';
			$retorno = 'img/defecto.png';
			if(is_dir($dir)){
				$imagenes = scandir($dir);
				$encuentro = FALSE;
				$i = 0;
				while (!$encuentro) {
					$img = $imagenes[$i];
					if($img != '.' && $img != '..' && $img != ''){
						$retorno = 'uploads/'.$id.'/'.$img;
						$encuentro = TRUE;
					}
					if($i > 2){	
						$encuentro = TRUE;
					}
					$i++;
				}
			}
			return $retorno;
		}

		protected function recortarDescripcion($descripcion, $cantidadCaracteres){
			$largoDescripcion = strlen($descripcion);
			if($largoDescripcion < 150){
				return $descripcion;
			}
			$recorte = substr($descripcion, 0, 150);
			$recorte.='...';
			return $recorte;
		}


	}