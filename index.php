<?php
// --- set logger ---
require_once 'logger/Logger.php';

// --- set page ---
require_once "model/crud.php";
$crud = new Crud();

if ($crud) {
    require_once "controller/main.controller.php";
    $controller = new MainController($crud);
    $controller->handleRequest();
}