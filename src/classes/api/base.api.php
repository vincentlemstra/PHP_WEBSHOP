<?php
require_once MODELS.'base.model.php';
abstract class BaseApi extends BaseModel {
    // --- PUBLIC METHODS ---
    public function execute() {
        if ($this->getData()) {
            return $this->showData();
        }

        return false;
    }

    // --- OVERRIDE METHODS ---
    abstract protected function getData();
    abstract protected function showData();
}