<?php
require_once "htmldoc.php";
class About extends HtmlDoc
{   
    // --- PROTECTED METHOD OVERRIDES ---
    protected function showMain() 
    { 
        echo '<p class="text">Zoals de titel al vermeld. Ik ben Vincent. Ik ben geboren op 2 januari 1999 in Bennekom, een klein dorpje naast Ede. Thuis waren we met zijn 6en, ik ben de jongste met 2 oudere broers en 1 zus. Nu woon ik, samen met mijn vrouw, in Arnhem.</p><p class="text">Na mijn lagere en middelbare school ben ik Bouwkunde gaan studeren aan de HAN in arnhem. Tijdens het werken als bouwtechnisch tekenaar ben ik erachter gekomen dat ik programmeren erg leuk vindt en daarom volg ik nu een software developer traineeship bij Educom.</p>';
    }
}