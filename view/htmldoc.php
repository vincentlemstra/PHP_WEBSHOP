<?php 
abstract class HtmlDoc
{
    protected $page;

    // --- CONSTRUCT ---
    public function __construct(string $page)
    {
        $this->page = $page;
    }
    
    // --- PUBLIC METHODS ---
    public function show()
    {
        $this->showHeader();
        $this->showNav();
        $this->showMain();
        $this->showFooter();
    }

    // --- ABSTRACT METHODS ---
    abstract protected function showMain();
    
    // --- PRIVATE METHODS ---
    private function showHeader() 
    { 
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/4_PHP_AJAX/css/styles.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Mr+Dafoe&family=Poppins&display=swap" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script src="/4_PHP_AJAX/js/main.js"></script>
            <title>'.$this->page.'</title> 
        </head>
        <body>

        <header><h1>vincent</h1></header>';
    }

    private function showNav()
    {
        echo '
        <nav>
        <ul class="menu">
            <li><a href="/4_PHP_AJAX/index.php?page=home">HOME</a></li>
            <li><a href="/4_PHP_AJAX/index.php?page=about">ABOUT</a></li>
            <li><a href="/4_PHP_AJAX/index.php?page=contact">CONTACT</a></li>
            <li><a href="/4_PHP_AJAX/index.php?page=shop">WEBSHOP</a></li>
            ';
            if (isset($_SESSION['email'])) 
            {
                echo ' <li><a href="/4_PHP_AJAX/index.php?page=cart">CART</a></li>';
                echo ' <li><a href="/4_PHP_AJAX/index.php?page=logout">LOGOUT [<span class="session_name">'.$_SESSION['name'].'</span>]</a></li>';
            }
            else
            {
                echo ' <li><a href="/4_PHP_AJAX/index.php?page=login">LOGIN</a></li>
                <li><a href="/4_PHP_AJAX/index.php?page=register">REGISTER</a></li>';
            }
            
            echo '
                </ul>
            </nav>  
    <main>';
    }

    private function showFooter()
    {
        echo '
                </main>
                <footer>
                    <p>&#169; 2022 Vincent Lemstra</p>
                </footer>
            </body>
        </html>
        ';
    }
}