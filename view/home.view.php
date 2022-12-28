<?php
require_once "htmldoc.php";
class Home extends HtmlDoc
{   
    // --- PROTECTED METHOD OVERRIDES ---
    protected function showMain() 
    { 
        echo '<p class="text">Welkom op mijn portfolio. Op deze website is informatie over mij te vinden en manieren om in contact met mij te komen.</p>'; 
    }
}