<?php
require_once "base.controller.php";
class PageBaseController extends BaseController implements iController
{
    // --- PROPERTIES ---
    protected $request;

    // --- PUBLIC METHODS ---
    final public function handleRequest() {
        $this->getRequest();
        $this->validateRequest();
        $this->showResponse();
    }

    // --- PRIVATE METHODS ---
    private function getRequest() {
        $posted = ($_SERVER['REQUEST_METHOD'] === 'POST'); // returns bool
        $this->request = 
            [
                'posted' => $posted, 
                'page'   => $this->getRequestVar('page', $posted, 'home') 
            ];
    }
}