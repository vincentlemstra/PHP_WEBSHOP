<?php
require_once "htmldoc.php";
class Response extends HtmlDoc
{   
    // --- PROPERTIES ---
    private $postresult;

    // --- CONSTRUCT ---
    public function __construct(string $page, array $postresult)
    {
        parent:: __construct($page);
        $this->postresult = $postresult;
    }

    // --- PROTECTED METHODS OVERRIDES ---
    protected function showMain() 
    { 
        echo '
        Thank you for reaching out '.$this->postresult["name"].'.<br>
        Naam: '.$this->postresult["name"].'<br>
        Email: '.$this->postresult["email"].'<br>
        Phone: '.$this->postresult["phone"].'<br>
        Bericht: '.$this->postresult["message"].'<br>  
        ';
    }
}