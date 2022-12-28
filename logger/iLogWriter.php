<?php     
interface iLogWriter
{
    public function _echo(string $msg);
    public function _dump(string $name, $var);
    public function _error(Throwable $e);
}