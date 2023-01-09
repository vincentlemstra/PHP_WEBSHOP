<?php
require_once "base.model.php";
class RatingModel extends BaseModel {
    // --- PUBLIC METHODS ---
    public function setRating($user_id, $product_id, $rating) {
        $sql = "SELECT id FROM rating WHERE user_id = ? AND product_id = ?";
        $var = [$user_id, $product_id];
        $user = $this->crud->read($sql, $var);

        if (!$user) {
            $sql = "INSERT INTO rating (user_id, product_id, rating) VALUES (?, ?, ?)";
            $var = [$user_id, $product_id, $rating];
            $this->crud->create($sql, $var);
        }   
    }

    public function getRatingInfo($id) : array {
        $result = [];
        $result['avgrating'] = $this->getAvgRating($id);
        $result['totalratings'] = $this->getTotalRatings($id);

        $result['userrated'] = false;
        $ratedUsers = $this->getRatedUsers($id);
        for ($i = 0; $i < count($ratedUsers); $i++) {
            if (isset($_SESSION['id'])) {
                if ($_SESSION['id'] == $ratedUsers[$i]['user_id']) {
                    $result['userrated'] = true;
                }
            }
        }

        return $result;
    }

    public function getAvgRating($id) : array {  
        $sql = "SELECT ROUND(AVG(rating), 1) AS rating FROM rating WHERE product_id = ?";
        $var = [$id];
        return $this->crud->read($sql, $var);
    }

    public function getTotalRatings($id) : int {
        $sql = "SELECT COUNT(*) FROM rating WHERE product_id = ?";
        $var = [$id];
        return $this->crud->count($sql, $var);
    }

    // --- PRIVATE METHODS ---
    private function getRatedUsers($id) : array {
        $sql = "SELECT DISTINCT user_id FROM rating WHERE product_id = ?";
        $var = [$id];
        return $this->crud->read($sql, $var);
    }
}
