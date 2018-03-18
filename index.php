<?php

require_once 'controllers/FrontController.php';

FrontController::main();

require('UploadHandler.php');

$upload_handler = new UploadHandler();

