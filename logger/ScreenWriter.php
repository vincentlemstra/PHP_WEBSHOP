<?php
################################################################################
# Author	: M@nKind - Geert Weggemans  
# Date 		: 12-01-2012
# Desc		: Base Logging class
################################################################################
require_once "iLogWriter.php";
class ScreenWriter implements iLogWriter
{
    public function _echo(string $msg)
    {
        echo '<pre>'.$msg.'</pre>';
    }
//==============================================================================
    public function _dump(string $name, $var)
    {   
        echo '<h3>'.$name.'</h3><pre>';
        is_array($var) ? print_r($var) : var_dump($var);
        echo '</pre>';
    }
//==============================================================================
    public function _error(Throwable $e)
    {   
        echo '<div class="error">'
            .'  <h3>Error ['.$e->getCode().']</h3>'
            .'  <p>File = ['.$e->getFile().']</p>'
            .'  <p>Line = ['.$e->getLine().']</p>'
            .'  <p>Msg = '.$e->getMessage().']</p>'
            .'</div>';    
    }
}


