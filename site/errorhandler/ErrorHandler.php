<?php
// namespace ManKind\tools\dev;
################################################################################
# Author	: M@nKind - Geert Weggemans  
# Date 		: 12-01-2012
# Desc		: Default Error Handler
################################################################################
class ErrorHandler
{
    protected static $sethandlers = 0;
//==============================================================================    
    public function __construct()
    {   
        self::init();
    }  
//==============================================================================    
    public static function init()
    {
        if (self::$sethandlers===0)
        {
            set_error_handler(__CLASS__.'::handleError'); 
            register_shutdown_function(__CLASS__.'::fatalErrorShutdownHandler');
            self::$sethandlers++;
        }
    }
//==============================================================================    
    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        switch ($errno) 
        {
        case E_USER_ERROR:
            Logger::_echo("My ERROR [$errno] $errstr", Loglevel::LVL_DEBUG);
            Logger::_echo("Fatal error on line $errline in file $errfile", Loglevel::LVL_DEBUG);
            exit(1);
        case E_USER_WARNING:
            Logger::_echo("My WARNING [$errno] $errstr", Loglevel::LVL_DEBUG);
            break;
        case E_USER_NOTICE:
            Logger::_echo("My NOTICE [$errno] $errstr", Loglevel::LVL_DEBUG);
            break;
        default:
            Logger::_echo("Unknown error type: [$errno] $errstr", Loglevel::LVL_DEBUG);
            Logger::_echo("Fatal error on line $errline in file $errfile", Loglevel::LVL_DEBUG);
            break;
        }
        Logger::_echo("PHP " . PHP_VERSION . " (" . PHP_OS . ")", Loglevel::LVL_DEBUG);
        return true;
    }
//==============================================================================
    public static function fatalErrorShutdownHandler()
    {
        $last_error = error_get_last();
        if ($last_error && $last_error['type'] === E_ERROR) 
        {
            self::handleError(E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
        }
    }
//==============================================================================    
}

