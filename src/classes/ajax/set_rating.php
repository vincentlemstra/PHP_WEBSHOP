<?php
require_once CLASSES.'base.flow.php';
class SetRating extends BaseFlow {
    // --- PROPERTIES ---
    protected $user_id;
    protected $product_id;
    protected $rating;
    protected $data;
    
    // --- CONSTRUCT ---
    public function __construct($crud) {
        parent::__construct($crud);
        $this->user_id = $_SESSION['id'];
        $this->product_id = $_GET['product_id'];
        $this->rating = $_POST['rating']; 
    }

    // --- OVERRIDES ---
    protected function getData() {
        require_once MODELS.'rating.model.php';
        $ratingModel = new RatingModel($this->crud);
        $this->data = $ratingModel->setRating($this->user_id, $this->product_id, $this->rating);
        return $this->data ? True : False;
    }
    
    protected function sendData() {
        header ("Content-type: application/json");
        echo json_encode($this->data);
    }
}