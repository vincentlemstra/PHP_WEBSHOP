<?php
################################################################################
# Author	: M@nKind - Geert Weggemans 
# Date 		: 12-01-2012
# Desc		: Base Profiler class with nested timers
# Dependencies  : LogLevel, Logger
################################################################################
abstract class Profiler
{
    const TIME = 0;
    const TRACE     = 1;
    const MEMUSED   = 2;
    const MEMPEAK   = 3;
    protected static $_timer = [];
//==============================================================================
    public static function startTimer()
    {
        $nowtime = microtime(true);
        array_push(self::$_timer, self::_makeInfoArray($nowtime)); 
    }
//==============================================================================
    public static function stopTimer($level=LogLevel::LVL_ALLWAYS)
    {  
        $stoptime = microtime(true);
        $stop = self::_makeInfoArray($stoptime);
        $c = count(self::$_timer);
        $start = array_pop(self::$_timer);
        if ($start)
        {    
            self::_logInfo("START TIMER ".$c,  $start);
            self::_logInfo(" STOP TIMER ".$c,  $stop);
            Logger::_echo("ELAPSED ".($stop[self::TIME] - $start[self::TIME])." seconds".PHP_EOL
                         ."MEM FREED ".($stop[self::MEMUSED] - $start[self::MEMUSED])." kb".PHP_EOL,
                        Loglevel::LVL_DEBUG);
        }
        else 
        {
            throw new Exception("Trying to stop an unstarted timer");
        }
        
    }
//==============================================================================
    protected static function _logInfo($title, $info)
    {
        Logger::_echo($title
                    ." at [".$info[self::TIME]."]".PHP_EOL
                    . " in file [".$info[self::TRACE][1]["file"]."]".PHP_EOL
                    . " line [".$info[self::TRACE][1]["line"]."]".PHP_EOL
                    . " mem-used [".$info[self::MEMUSED]."kb]".PHP_EOL
                    . " mem-peak [".$info[self::MEMPEAK]."kb]".PHP_EOL, 
                    Loglevel::LVL_DEBUG);
    }
//==============================================================================
    protected static function _makeInfoArray($time)
    {
        return [
            $time, 
            debug_backtrace(),
            round(memory_get_usage()/1024),
            round(memory_get_peak_usage() / 1024)
        ];  
    }        
}
