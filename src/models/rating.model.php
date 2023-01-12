<?php
require_once "base.model.php";
class RatingModel extends BaseModel {
    // todo deel van deze functies staan al in models/ajax/ : REFACTOR (?)
    // * nodig om gegevens te laden wanneer GET aanvraag
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

    // --- PRIVATE METHODS ---
    private function getAvgRating($id) : array {  
        $sql = "SELECT ROUND(AVG(rating), 1) AS rating FROM rating WHERE product_id = ?";
        $var = [$id];
        return $this->crud->read($sql, $var);
    }

    private function getTotalRatings($id) : int {
        $sql = "SELECT COUNT(*) FROM rating WHERE product_id = ?";
        $var = [$id];
        return $this->crud->count($sql, $var);
    }

    private function getRatedUsers($id) : array {
        $sql = "SELECT DISTINCT user_id FROM rating WHERE product_id = ?";
        $var = [$id];
        return $this->crud->read($sql, $var);
    }
}
