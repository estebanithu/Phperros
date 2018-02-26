<?php

	class LoginController extends BaseController{

		public function __construct(){
			parent::__construct();
		}

		public function index(){
			$this->miSmarty->display('login/index.tpl');
		}

	}