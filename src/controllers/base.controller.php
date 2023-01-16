<?php
require_once INTERFACES.'icontroller.php';
abstract class BaseController implements iController {
    // --- PROPERTIES ---
    protected $crud;

    // --- CONSTRUCT ---
    public function __construct(Crud $crud) {
        $this->crud = $crud;
    }

    // --- OVERRIDE METHODS ---
    abstract function handleRequest();

    // --- PROTECTED METHODS ---
    protected function getVar($name, $default="none") {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }

    protected static function getArrayVar($array, $key, $default='') {
        return (isset($array[$key])) ? $array[$key] : '';
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