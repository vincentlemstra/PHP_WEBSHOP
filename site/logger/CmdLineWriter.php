<?php
################################################################################
# Author	: M@nKind - Geert Weggemans  
# Date 		: 12-01-2012
# Desc		: Base Logging class
################################################################################
require_once "iLogWriter.php";
class CmdlineWriter implements iLogWriter
{
    public function _echo(string $msg)
    {
        echo $msg.PHP_EOL;
    }
//==============================================================================
    public function _dump(string $name, $var)
    {   
        echo $name.PHP_EOL;
        is_array($var) ? print_r($var) : var_dump($var);
        echo PHP_EOL;
    }
//==============================================================================
    public function _error(Throwable $e)
    {   
        echo $e->getCode().PHP_EOL
            .$e->getFile().PHP_EOL
            .$e->getLine().PHP_EOL
            .$e->getMessage().PHP_EOL;    
    }
}


