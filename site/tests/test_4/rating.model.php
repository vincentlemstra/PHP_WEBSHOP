<?php
require_once "base.model.php";
class RatingModel extends BaseModel {
    public function setRating($user_id, $product_id, $rating) {
        $sql = "INSERT INTO rating (user_id, product_id, rating) VALUES (?, ?, ?)";
        $var = [$user_id, $product_id, $rating];
        $this->crud->create($sql, $var);
    }

    public function getAvgRating($id) : array {  
        $sql = "SELECT ROUND(AVG(rating), 1) AS rating FROM rating WHERE product_id = ?";
        $var = [$id];
        return $this->crud->read($sql, $var);
    }

    private function getRating($id) : array {
        $sql = "SELECT rating FROM rating WHERE id = ?";
        $var = [$id];
        return $this->crud->read($sql, $var);
    }
}
