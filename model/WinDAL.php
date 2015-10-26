<?php


class WinDAL
{
    private $wins;
    
    public function __construct()
    {
        $this->wins = array();
        $this->binFile = 'data/win.bin';
       
        if (file_exists($this->binFile))
        {
            $this->wins = unserialize(file_get_contents($this->binFile));
        }
        else
        {
            $this->clear();
        }
    }
    
    public function saveWin($winObject)
    {
        
        if(empty($this->wins))
        {
            $this->wins = array();
        }
        
        
        array_push($this->wins, $winObject);
        
        $serilized = serialize($this->wins);
        
        file_put_contents($this->binFile, $serilized);
        
    }
    
    public function clear()
    {
        file_put_contents($this->binFile, serialize(array()));
        $this->wins = array();
    }
    
    public function getDay(DateTime $currentdate)
    {
        if(!empty($this->wins))
        foreach($this->wins as $day)
        {
            if ($day->getDate()->format("Y-m-d") == $currentdate->format("Y-m-d"))
            {
                return $day;
            }
        }
        return null;
    }
    
    public function getWins()
    {
        
        return $this->wins;
    }
    
}