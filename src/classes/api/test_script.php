<?php
echo '<h1>Get all items (JSON):</h1>';
$getAllItems = file_get_contents('http://localhost:8080/4_PHP_AJAX/index.php?action=api&func=get_all_items&type=json');
echo $getAllItems;

echo '<h1>Get item (JSON):</h1>';
$getItem = file_get_contents('http://localhost:8080/4_PHP_AJAX/index.php?action=api&func=get_item&id=1&type=json');
echo $getItem;