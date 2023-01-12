<?php
require_once "base.controller.php";
class MainController extends BaseController implements iController {
    // --- PROPERTIES ---
    protected $action;
    
    // --- CONSTRUCT ---
    public function __construct($crud) {
        parent::__construct($crud);
        if(!isset($_SESSION)) { 
            session_start(); 
        }

        $this->action = $this->getVar("action", "page");
    }

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
        $controller->handleRequest();
    }
}