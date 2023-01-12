<?php
require_once "base.model.php";
class RatingModel extends BaseModel {
    public function getRatingInfo($product_id) : array {
        $result = [];
        $result['avgrating'] = $this->getAvgRating($product_id);
        $result['totalratings'] = $this->getTotalRatings($product_id);

        $result['userrated'] = false;
        $ratedUsers = $this->getRatedUsers($product_id);
        for ($i = 0; $i < count($ratedUsers); $i++) {
            if (isset($_SESSION['id'])) {
                if ($_SESSION['id'] == $ratedUsers[$i]['user_id']) {
                    $result['userrated'] = true;
                }
            }
        }

        return $result;
    }

    // --- PUBLIC METHODS ---
    public function setRating($user_id, $product_id, $rating) {
        $sql = "SELECT id FROM rating WHERE user_id = ? AND product_id = ?";
        $var = [$user_id, $product_id];
        $user = $this->crud->read($sql, $var);

        if (!$user) {
            $sql = "INSERT INTO rating (user_id, product_id, rating) VALUES (?, ?, ?)";
            $var = [$user_id, $product_id, $rating];
            return $this->crud->create($sql, $var);
        }   
    }

    public function getAvgRating($product_id) : array {  
        $sql = "SELECT ROUND(AVG(rating), 1) AS rating FROM rating WHERE product_id = ?";
        $var = [$product_id];
        return $this->crud->read($sql, $var);
    }

    public function getTotalRatings($product_id) : int {
        $sql = "SELECT COUNT(*) FROM rating WHERE product_id = ?";
        $var = [$product_id];
        return $this->crud->count($sql, $var);
    }

    // --- PRIVATE METHODS ---
    private function getRatedUsers($product_id) : array {
        $sql = "SELECT DISTINCT user_id FROM rating WHERE product_id = ?";
        $var = [$product_id];
        return $this->crud->read($sql, $var);
    }
}
