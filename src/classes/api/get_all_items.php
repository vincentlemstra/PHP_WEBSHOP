<?php
require_once 'base.api.php';
class GetAllItems extends BaseApi {
    // --- PROPERTIES ---
    protected $data;

    
    // --- CONSTRUCT ---
    public function __construct($crud) {
        parent::__construct($crud);
    }

    // --- OVERRIDES ---
    protected function getData() {
        require_once MODELS.'shop.model.php';
        $shopModel = new ShopModel($this->crud);
        return $this->data = $shopModel->getShopContent();
    }

    protected function showData() {
        require_once 'show_data.php';
        $showData = new ShowData($this->data);
        return $showData->showData();
    }
}