<?php
require_once MODELS.'base.model.php';
abstract class BaseFlow extends BaseModel {
    // --- PUBLIC METHODS ---
    public function execute() {
        if ($this->getData()) {
            return $this->sendData();
        }

        return false;
    }

    // --- OVERRIDE METHODS ---
    abstract protected function getData();
    abstract protected function sendData();
}