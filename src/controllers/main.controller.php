<?php
require_once INTERFACES.'icontroller.php';
class MainController implements iController {
    // --- PROPERTIES ---
    protected $action;
    protected $crud;

    // --- CONSTRUCT ---
    public function __construct($crud) {
        if(!isset($_SESSION)) { 
            session_start(); 
        }

        $this->action = $this->getVar("action", "page");
        $this->crud = $crud;
    }

    // --- PUBLIC METHODS ---
    public function handleRequest()
    {
        switch($this->action) {
            case 'ajaxcall':
                require_once CONTROLLERS.'ajax.controller.php';
                $controller = new AjaxController($this->crud);
                break;
            case 'page':
            default:
                require_once CONTROLLERS.'page.controller.php';
                $controller = new PageController($this->crud);
                break;
        }
        $controller->handlerequest();
    }

    // --- PROTECTED METHODS ---
    protected function getVar($name, $default="none") {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }

    protected static function getArrayVar($array, $key, $default='') {
        return (isset($array[$key])) ? $array[$key] : '';
    }
}