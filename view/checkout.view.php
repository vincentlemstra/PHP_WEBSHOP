<?php
require_once "htmldoc.php";
class Checkout extends HtmlDoc
{   
    // --- PROTECTED METHOD OVERRIDES ---
    protected function showMain() 
    { 
        echo '
        <h1>Your order has been placed</h1>
        <p>Thank you for ordering with us, we will contact you by email with your order details.</p>
        ';
    }
}