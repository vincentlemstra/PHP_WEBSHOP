<?php 
require_once "base.controller.php";
class AjaxController extends BaseController implements iController {
    // --- PROPERTIES ---
    protected $func;
    protected $handler;

    // --- PUBLIC METHODS ---
    public function handleRequest() {
        try {    
            // start output buffer 
            ob_start();

            // handle request
            $this->func = $this->getVar('func');
            $this->createHandler();
            $this->executeHandler();

            // stop and echo buffer       
            ob_end_flush();
        }
        catch (Exception $e) {
            // stop and empty buffer     
            ob_end_clean();
            // send error header + error message 
            header('HTTP/1.1 500 Internal Server Error');
            throw new Exception($e->getMessage());
        }
    }

    // --- PRIVATE METHODS ---
    private function createHandler() { 
        switch($this->func) {
            case "set_rating":
                require_once CLASSES.'ajax/set_rating.php';
                $this->handler = new SetRating($this->crud);
                break;
            case "get_rating_info":
                require_once CLASSES.'ajax/get_rating_info.php';
                $this->handler = new GetRatingInfo($this->crud);
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