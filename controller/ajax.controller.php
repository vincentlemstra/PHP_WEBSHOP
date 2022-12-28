<?php 
require_once "main.controller.php";
class AjaxController extends MainController implements iController {
    // --- PUBLIC METHODS ---
    public function handleRequest() {
        try {    
            // start output buffer 
            ob_start();
            
            require_once 'model/rating.model.php';
            $ratingModel = new RatingModel($this->crud);

            $func = $this->getVar('func');
            switch ($func) {
                case "set_rating":
                    $ratingModel->setRating($_SESSION['id'], $_GET['product_id'], $_POST['rating']);
                    break;
                // ? kunnen deze worden samengevoegd tot 1? -> getRatingInfo
                case "get_avg_rating":
                    $data = $ratingModel->getAvgRating($_GET['product_id']);
                    header ("Content-type: application/json");
                    echo json_encode($data);
                    break;
                case "get_total_ratings":
                    $data = $ratingModel->getTotalRatings($_GET['product_id']);
                    header ("Content-type: application/json");
                    echo json_encode($data);
                    break;
                // ?
                default:
                    echo "<h1>OOPS : no action defined for [".$func."]</h1>";
                    break;
            }

            // stop and echo buffer       
            ob_end_flush();
        }
        catch (Exception $e) {
            // stop and empty buffer     
            ob_end_clean();
            // send error header + error message 
            header('HTTP/1.1 500 Internal Server Error');
            echo $e->getMessage();
        }
    }
}