<?php
require_once "htmldoc.php";
class Item extends HtmlDoc
{  
    // --- PROPERTIES ---
    private $itemcontent;
    private $itemrating;

    // --- CONSTRUCT ---
    public function __construct(string $page, array $itemcontent, array $itemrating)
    {
        parent:: __construct($page);
        $this->itemcontent = $itemcontent;
        $this->itemrating = $itemrating;
    }

    // --- PROTECTED METHOD OVERRIDES ---
    protected function showMain() 
    { 
        // show data
        echo '<div class="detail-page">';
            if (isset($this->itemcontent[0]['id'])) {
                echo '
                <div class="detail-page-left">
                    <img src="'. $this->itemcontent[0]["image_detail_1"].'" alt="detail img" width="400" height="400">
                </div>

                <div class="detail-page-right">
                    <h2>'.$this->itemcontent[0]["name"].'</h2>
                    <div class="detail-page-rating">';
                        if (isset($_SESSION['email']))  {
                            if ($this->itemrating['userrated']) {
                                echo 'You already left your review for this product.';
                            } else {
                                echo '
                            <form class="rating_form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                                <input id="rating" type="number" name="rating" value="5.0" min="1" max="5.0" step="0.1" required>
                                <button id="btn_add_rating" type="submit" name="submit" >RATE</button>
                            </form>
                            <p><span id="rating_message"></span></p>';
                            }
                        } else {
                            echo '<a href="/4_PHP_AJAX/index.php?page=login">Please login to rate</a>';
                        }
                    echo ' 
                    </div>    

                    <h3>Rating: <span id="avg_rating">'.$this->itemrating['avgrating'][0]['rating'].'</span>/5.0 (<span id="total_ratings">'.$this->itemrating['totalratings'].'</span> total ratings)</h3>
                    <p>'.$this->itemcontent[0]["description"].'</p>
                    <ul>
                        <li><h3>Product Features</h3></li>
                        <li>Tip Material: '.$this->itemcontent[0]["tip_material"].'</li>
                        <li>Tip Shape: '.$this->itemcontent[0]["tip_shape"].'</li>
                        <li>Length: '.$this->itemcontent[0]["length"].'</li>
                        <li>Diameter: '.$this->itemcontent[0]["diameter"].'</li>
                    </ul>
                    <div class="detail-page-buy">';           
                    if (isset($_SESSION['email']))  {
                        echo '
                        <form class="standard_form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                            <input type="hidden" name="page" value="cart">
                            <input type="number" name="quantity" value="1" min="1" max="'.$this->itemcontent[0]["stock"].'" required>
                            <input type="hidden" name="product_id" value="'.$this->itemcontent[0]["id"].'">
                            <button type="submit" name="add_to_cart">ADD TO CART</button>
                        </form>';
                    } else {
                        echo '<a href="/4_PHP_AJAX/index.php?page=login">Please login to order</a>';
                    }
                echo '
                    <h3>€'.$this->itemcontent[0]["price"].'</h3>
                    </div>
                </div>
                ';
            } 
            else {
                echo '<p>Dit aangevraagde item bestaad niet.<p>';            
            }
        echo '</div>';
    }
}

