<?php 
require_once "base.controller.php";
class APIController extends BaseController implements iController {
    // --- PROPERTIES ---
    protected $func;
    protected $handler;

    // --- PUBLIC METHODS ---
    public function handleRequest() {
        $this->func = $this->getVar('func');
        $this->createHandler();
        $this->executeHandler();
    }

    // --- PRIVATE METHODS ---
    private function createHandler() { 
        switch($this->func) {
            case "get_all_items":
                require_once CLASSES.'api/get_all_items.php';
                $this->handler = new GetAllItems($this->crud);
                break;
            case "get_item":
                require_once CLASSES.'api/get_item.php';
                $this->handler = new GetItem($this->crud);
                break;
            default:
                echo "<h1>No action defined for [".$this->func."]</h1>";
                break;
        }
    }

    private function executeHandler() {
        if ($this->handler) {
            $this->handler->execute();
        }
    }
}