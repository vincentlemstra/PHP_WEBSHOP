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
}