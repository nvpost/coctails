<?php


class TimeLogClass
{
    public $start;
    public $name;

    public function __construct($name)
    {
        $this->start = microtime(true);
        $this->name = $name;
    }

    public function timerStop(){
        $time_log = $this->name.'. t: '.round(microtime(true) - $this->start, 4).'s.';
        c_deb($time_log);
    }

    public function relatedTimeStop($name){
        $time_log = $name.'. t: '.round(microtime(true) - $this->start, 4).'s.';
        c_deb($time_log);
    }
}