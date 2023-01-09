<?php

require_once "crud.php";
$crud = new Crud();

require_once "rating.model.php";
$ratingModel = new RatingModel($crud);

$data = $ratingModel->getAvgRating(1);
header ("Content-type: application/json");
echo json_encode($data);
