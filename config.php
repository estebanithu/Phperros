<?php

require_once 'libs/Smarty.class.php';

function getSmarty() {
    $miSmarty = new Smarty();
    $miSmarty->template_dir = "views";
    $miSmarty->compile_dir = "views_c";
    $miSmarty->cache_dir = "cache";
    $miSmarty->config_dir = "config";
    //$miSmarty->assign("usuario", usuarioLogueado());
    return $miSmarty;
}

$_SERVER['BASE_HEADER'] = '/Phperros/';
$_SERVER['SITIO_URL'] = 'http://localhost:8888/Phperros/';
$_SERVER['SITIO_NOMBRE'] = 'Phperros&Cia.';
$_SERVER['SITIO_AUTOR'] = 'Esteban Ithurralde - Rodrigo Pintos';
$_SERVER['SITIO_DESCRIPCION'] = 'Phperros&Cia. Mascotas Perdidas y encontradas';
$_SERVER['SITIO_CANTIDAD_ANUNCIOS_HOME'] = '12';
$_SERVER['BD_MOTOR'] = 'mysql';
$_SERVER['BD_SERVIDOR'] = 'localhost';
$_SERVER['BD_NOMBRE'] = 'estebani_mascotas';
$_SERVER['BD_USUARIO'] = 'estebani_mascota';
$_SERVER['BD_PASSWORD'] = 'Masc0tas20!8';