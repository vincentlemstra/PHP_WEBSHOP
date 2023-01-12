<?php
require_once 'base.async.php';
class SetRating extends BaseAsync {
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
        return $this->data = $this->setRating();
    }
    
    protected function sendData() {
        return true;
    }

    // --- PRIVATE METHODS ---
    private function setRating() {
        $sql = "SELECT id FROM rating WHERE user_id = ? AND product_id = ?";
        $var = [$this->user_id, $this->product_id];
        $user = $this->crud->read($sql, $var);

        if (!$user) {
            $sql = "INSERT INTO rating (user_id, product_id, rating) VALUES (?, ?, ?)";
            $var = [$this->user_id, $this->product_id, $this->rating];
            return $this->crud->create($sql, $var);
        }   
    }
}