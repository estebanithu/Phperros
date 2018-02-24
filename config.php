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