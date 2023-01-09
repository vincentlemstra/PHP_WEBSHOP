<?php

require_once "crud.php";
$crud = new Crud();

require_once "rating.model.php";
$ratingModel = new RatingModel($crud);

$rating = $_POST['rating'];
$ratingModel->setRating(31, 1, $rating);
