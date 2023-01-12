<?php
require_once 'base.api.php';
class GetItem extends BaseApi {
    // --- PROPERTIES ---

    
    // --- CONSTRUCT ---
    public function __construct($crud) {
        parent::__construct($crud);
    }

    // --- OVERRIDES ---
    protected function getData() {
        $product_id = $_GET['id'];
        require_once MODELS.'shop.model.php';
        $shopModel = new ShopModel($this->crud);
        return $this->data = $shopModel->getItemContent($product_id);
    }

    protected function showData() {
        require_once 'show_data.php';
        $showData = new ShowData($this->data);
        return $showData->showData();
    }
}