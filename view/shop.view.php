<?php
require_once "htmldoc.php";
class Shop extends HtmlDoc
{  
    // --- PROPERTIES ---
    private $shopcontent;

    // --- CONSTRUCT ---
    public function __construct(string $page, array $shopcontent)
    {
        parent:: __construct($page);
        $this->shopcontent = $shopcontent;
    }

    // --- PROTECTED METHOD OVERRIDES ---
    protected function showMain() 
    { 
        echo '<div class="webshop-items">';
            foreach ($this->shopcontent as $content => $this->shopcontent) {
                // echo $this->webshopContent['name'];
                echo '
                <a href="/4_PHP_AJAX/index.php?page=item&id='.$this->shopcontent["id"].'">
                    <div class="webshop-item">
                        <img src="'. $this->shopcontent["image_main"].'" alt="main img" width="200" height="200">
                        <h3>'.$this->shopcontent["name"].'</h3>
                        <h4>€'.$this->shopcontent["price"].'</h4>
                    </div>
                </a>';
            }
        echo '</div>';

    }
}

