<?php
################################################################################
# Author	: M@nKind - Geert Weggemans  
# Date 		: 12-01-2012
# Desc		: Log File Writer
################################################################################
require_once "iLogWriter.php";
class LogFileWriter implements iLogWriter
{
    protected $file;
    protected $user;
    protected $datetime;
//==============================================================================
    public function __construct($path)
    {
        $this->user  = $_SESSION['fullname'] 
                    ?? $_SERVER['REMOTE_ADDR'] 
                    ?? "unknown";
        $this->dateTime   = new DateTime("now");
        $dow        = $this->dateTime->format('l');
        $w          = $this->dateTime->format('W');
        $fn         = $path . "log_".$dow.".txt";
        $this->file = (is_file($fn)&&$w == date('W',filemtime($fn))) 
                    ? fopen($fn,"a") 
                    : fopen($fn,"w");
    }        
//==============================================================================
    public function __destruct()
    {
        fclose($this->file);
    }        
//==============================================================================
    public function _echo(string $msg)
    {
        $this->writeToLogFile($msg); 
    }        
//==============================================================================
    public function _dump(string $name, $var)
    {
        $this->writeToLogFile($name." => [".var_export($var, true)."]"); 
    }        
//==============================================================================
    public function _error(Throwable $e)
    {
        $this->writeToLogFile(
                    ">>>>>> Error [".$e->getCode().
                    "] on line ".$e->getLine().
                    " in file ".$e->getFile()
        );
        $this->writeToLogFile(
                    ">>>>>> ".
                    $e->getMessage()
        );
    }        
//==============================================================================
    private function writeToLogFile($logmsg)
    {
        fprintf(
                $this->file,
                "%s | %.50s | %s \n",  
                $this->dateTime->format("d-m-Y G:i:s"), 
                $this->user,
                $logmsg
        );
    }
}
