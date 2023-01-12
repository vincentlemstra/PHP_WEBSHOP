<?php
require_once 'base.async.php';
class GetRatingInfo extends BaseAsync {
    // --- PROPERTIES ---
    protected $product_id;
    protected $data;
    
    // --- CONSTRUCT ---
    public function __construct($crud) {
        parent::__construct($crud);
        $this->product_id = $_GET['product_id'];
    }

    // --- OVERRIDES ---
    protected function getData() {
        $this->data = [];
        $this->data['avg_rating'] = $this->getAvgRating();
        $this->data['total_ratings'] = $this->getTotalRatings();
        return $this->data;
    }
    
    protected function sendData() {        
        header ("Content-type: application/json");
        echo json_encode($this->data);
    }

    // --- PRIVATE METHODS ---
    private function getAvgRating() : array {  
        $sql = "SELECT ROUND(AVG(rating), 1) AS rating FROM rating WHERE product_id = ?";
        $var = [$this->product_id];
        return $this->crud->read($sql, $var);
    }

    private function getTotalRatings() : int {
        $sql = "SELECT COUNT(*) FROM rating WHERE product_id = ?";
        $var = [$this->product_id];
        return $this->crud->count($sql, $var);
    }
}