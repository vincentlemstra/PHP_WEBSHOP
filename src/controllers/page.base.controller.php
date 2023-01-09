<?php
require_once "main.controller.php";
class PageBaseController extends MainController implements iController
{
    // --- PROPERTIES ---
    protected $request;

    // --- PUBLIC METHODS ---
    public function handleRequest() {
        $this->getRequest();
        $this->validateRequest();
        $this->showResponse();
    }

    // --- PROTECTED METHODS ---
    protected function getRequest() {
        $posted = ($_SERVER['REQUEST_METHOD'] === 'POST'); // returns bool
        $this->request = 
            [
                'posted' => $posted, 
                'page'   => $this->getRequestVar('page', $posted, 'home') 
            ];
    }

    protected function getRequestVar(string $key, bool $posted, $default="", bool $asnumber=FALSE) {
        // FILTER_SANITIZE_NUMBER_FLOAT removes all illegal characters from a float number
        // FILTER_SANITIZE_STRING removes tags and encodes special characters from a string
        $filter = $asnumber ? FILTER_SANITIZE_NUMBER_FLOAT : FILTER_SANITIZE_STRING;
        // checks $key with $filter -> returns bool
        $result = filter_input(($posted ? INPUT_POST : INPUT_GET), $key, $filter);
        // if check failed -> show home -> else page
        return ($result===FALSE) ? $default : $result;
    }
}