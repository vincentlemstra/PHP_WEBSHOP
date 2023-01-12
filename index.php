<?php
// --- set config
define('DEV', $_SERVER['HTTP_HOST']==='localhost:8080'); 
include 'config/'.(DEV?'dev':'prod').'.php';

// --- set logger ---
require_once LOGGER.'Logger.php';

// --- set page ---
require_once MODELS.'crud.php';
$crud = new Crud();

if ($crud) {
    require_once CONTROLLERS.'main.controller.php';
    $controller = new MainController($crud);
    $controller->handleRequest();
}