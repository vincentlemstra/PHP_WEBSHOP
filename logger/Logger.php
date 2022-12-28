<?php
require_once "CmdLineWriter.php";
require_once "LogFileWriter.php";
require_once "ScreenWriter.php";

################################################################################
# Author	: M@nKind - Geert Weggemans  
# Date 		: 12-01-2012
# Desc		: Base Logging class
################################################################################
class LogTarget
{
    const TO_LOG  = 0x01; //0000 0001
    const TO_SCR  = 0x02; //0000 0010
    const TO_ME   = 0x04; //0000 0100
    const TO_CMDLINE = 0x08; //0000 1000
}
//==============================================================================
class LogLevel
{
    const LVL_EMERGENCY = 0x01;
    const LVL_ALERT     = 0x02;
    const LVL_CRITICAL  = 0x04;
    const LVL_ERROR     = 0x08;
    const LVL_WARNING   = 0x10;
    const LVL_NOTICE    = 0x20;
    const LVL_INFO      = 0x40;
    const LVL_DEBUG     = 0x80;
    const LVL_ALLWAYS   = 0xFF;
}
//==============================================================================
// LOGGER
//==============================================================================
class Logger
{
    // public static $logpath = 'logs/' ;
    public static $logpath = 'logger/logs/' ;
    public static $level  = LogLevel::LVL_ALLWAYS;
    private static $target = LogTarget::TO_LOG|LogTarget::TO_SCR;
    private static $writers = null;
//==============================================================================
    public function __construct(string $logpath, int $logtarget, int $loglevel)
    {
        self::init($logpath,$logtarget,$loglevel);
    }
//==============================================================================
    public static function init(string $logpath, int $logtarget, int $loglevel)
    {
        self::$logpath = $logpath;
        self::$writers = null;
        self::$target = $logtarget;
        self::$level = $loglevel;
    }        
//==============================================================================	
    public static function hasTarget(int $target) : bool
    {
        return  (self::$target & $target) == $target;
    }    
//==============================================================================
    public static function _error(Throwable $e, int $level=LogLevel::LVL_ALLWAYS)
    {
        if (($level & self::$level) == $level)
        {    
            foreach (self::getWriters() as $writer)
            {    
                $writer->_error($e);
            }        
        }    
    }    
//==============================================================================
    public static function _dump(string $name, $var, int $level=LogLevel::LVL_ALLWAYS)
    {
        if (($level & self::$level) == $level)
        {    
            foreach (self::getWriters() as $writer)
            {    
                $writer->_dump($name, $var);
            }        
        }    
    }	
//==============================================================================
    public static function _echo(string $msg, int $level=LogLevel::LVL_ALLWAYS)
    {
        if (($level & self::$level) == $level)
        {    
            foreach (self::getWriters() as $writer)
            {    
                $writer->_echo($msg);
            }        
        }    
    }	
//==============================================================================
    private static function getWriters() : array
    {
        if (is_null(self::$writers))
        {    
            self::$writers = [];
            if (self::hasTarget(LogTarget::TO_LOG))
            {
                self::$writers[] = new LogFileWriter(self::$logpath);
            }  
            if (self::hasTarget(LogTarget::TO_SCR))
            {
                self::$writers[] = new ScreenWriter(true);
            }    
            else 
            {
                if (self::hasTarget(LogTarget::TO_CMDLINE))
                {
                    self::$writers[] = new CmdlineWriter(false);
                }    
            }
            if (self::hasTarget(LogTarget::TO_ME))
            {
                //TO DO !! self::$writers[] = new Mailer();
            }  
        }    
        return self::$writers;
    }        
//==============================================================================	
}