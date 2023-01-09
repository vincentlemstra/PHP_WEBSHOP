

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My test page</title>
    <link href="styles/style.css" rel="stylesheet" type="text/css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="scripts/main.js"></script>
</head>

<body>
    <h1>Product ID: 1</h1>


    <button id="btn_get_avg_rating" type="submit" name="submit" >Get avg rating</button>
    <h3>Average rating: <span id="avg_rating">0.0</span> / 5</h3>

    <form id="rating_form" method="POST">
        <input id="rating" type="number" name="rating"  value="5.0" min="1" max="5.0" step="0.1">
        <button id="btn_add_rating" type="submit" name="submit" >Rate!</button>
    </form>

    <h3>Your rating: <span id="user_rating">0.0</span> / 5</h3>
    
    <p class="rating_message"></p>
</body>

</html>