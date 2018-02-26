<?php
	class FrontController
	{
		static function main()
		{
			require_once 'config.php';
			require_once 'controllers/BaseController.php';
			require_once 'models/baseModel.php';

			
			//Formamos el nombre del Controlador o en su defecto, tomamos que es el loginController
			$controllerName = self::obtenerController();
			$actionName = self::obtenerAction();
			$parametro = self::obtenerParametro();

			
			$controllerPath = 'controllers/'.$controllerName.'.php';
			//Incluimos el fichero que contiene nuestra clase controladora solicitada	
			is_file($controllerPath) ? require_once $controllerPath : die('No existe el controllador');

			
			
			//Si no existe la clase que buscamos y su accion, tiramos un error 404
			if (!is_callable(array($controllerName, $actionName))) 
			{
				trigger_error ($controllerName . '->' . $actionName . ' no existe', E_USER_NOTICE);
				return false;
			}
			//Si todo esta bien, creamos una instancia del controlador y llamamos a la accion
			$controller = new $controllerName();

			if(!is_null($parametro)){
				$controller->$actionName($parametro);
			}else{
				$controller->$actionName();
			}

		}


		static private function obtenerController(){
			$controller = self::obtenerParte($_SERVER['REQUEST_URI'] , 2);
			return empty($controller) || is_null($controller) ? 'IndexController' : $controller.'Controller';
		}

		static private function obtenerAction(){
			$action =  self::obtenerParte($_SERVER['REQUEST_URI'] , 3);
			return empty($action) || is_null($action) ? 'index' : $action;
		}

		static private function obtenerParametro(){
			$parametro =  self::obtenerParte($_SERVER['REQUEST_URI'] , 4);
			return $parametro;
		}

		static private function obtenerParte($ruta, $parte){
			$partes = explode('/', $ruta);
			if(isset($partes[$parte])){
				$retorno = $partes[$parte];
			}else{
				$retorno = NULL;
			}
			return $retorno;
		}

	}
