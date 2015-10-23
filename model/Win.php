<?php


class Win
{
    private $winningName;
    private $date;
    
    public function __construct($winningName)
    {
        $this->date = new DateTime("now");
        $this->winningName = $winningName;
    }
    
    public function getWinningName()
    {
        return $this->winningName;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
}