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
        require_once MODELS.'rating.model.php';
        $ratingModel = new RatingModel($this->crud);

        $this->data = [];
        $this->data['avg_rating'] = $ratingModel->getAvgRating($this->product_id);
        $this->data['total_ratings'] = $ratingModel->getTotalRatings($this->product_id);
        return $this->data;
    }
    
    protected function sendData() {        
        header ("Content-type: application/json");
        echo json_encode($this->data);
    }
}