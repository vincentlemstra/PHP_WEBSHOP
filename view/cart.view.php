<?php
require_once "htmldoc.php";
class Cart extends HtmlDoc
{  
    // --- PROPERTIES ---
    private $cartcontent;
    private $totalPrice;

    // --- CONSTRUCT ---
    public function __construct(string $page, $cartcontent)
    {
        parent:: __construct($page);
        $this->cartcontent = $cartcontent;
    }

    // --- PROTECTED METHOD OVERRIDES ---
    protected function showMain() 
    { 
        echo '<div class="cart">';
        if (isset($_SESSION['cart'])) {
            foreach ($this->cartcontent as $content => $this->cartcontent) {
                echo '
                <div class="cart-item">
                    <img src="'. $this->cartcontent["image_main"].'" alt="main img" width="100" height="100">
                    <h3>'.$this->cartcontent["name"].'</h3>
                    <h4>€'.$this->cartcontent["price"].'</h4>
                    <h4>Quantity: '.$_SESSION['cart'][$this->cartcontent["id"]].'</h4>
                    <h4>Sub-total: €'.($_SESSION['cart'][$this->cartcontent["id"]] * $this->cartcontent["price"]).'</h4>
                </div>
                ';
                // calc total shopping cart price
                $this->totalPrice += $_SESSION['cart'][$this->cartcontent["id"]] * $this->cartcontent["price"];
            }
    
            // show total shopping cart price
            echo '<h2>Total: €'.$this->totalPrice.'</h2></div>';
            echo '
            <form method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                <input type="hidden" name="page" value="checkout">
                <button type="submit" name="checkout">CHECKOUT</button>
            </form>';
        } else {
            echo 'Your cart is empty.';
        }
    }
}

