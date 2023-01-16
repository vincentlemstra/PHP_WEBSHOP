<?php
require_once CLASSES.'base.flow.php';
class GetItem extends BaseFlow {
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

    protected function sendData() {
        require_once 'send_data.php';
        $sendData = new SendData($this->data);
        return $sendData->sendData();
    }
}