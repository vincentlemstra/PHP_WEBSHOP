<?php
require_once CLASSES.'base.flow.php';
class GetAllItems extends BaseFlow {
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

    protected function sendData() {
        require_once 'send_data.php';
        $sendData = new SendData($this->data);
        return $sendData->sendData();
    }
}