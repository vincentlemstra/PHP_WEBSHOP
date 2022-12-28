<?php

require_once 'Logger.php';
require_once 'Profiler.php';

// test variable for _dump
$y = 0;
for ($i=0; $i < 10000; $i++) {
    $y += $i;
}

// om profiler te starten:
Profiler::startTimer();

// de drie funcites die je kunt gebruiken
Logger::_echo('test');
Logger::_error(new Exception('oops'));
Logger::_dump('y', $y);

// om profiler te stoppen:
Profiler::stopTimer();