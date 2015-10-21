<?php


class UserDAL
{
    
    public function __construct()
    {
        $this->dates = array();
        $this->binFile = 'data/quizUsers.bin';
    }
    
    public function save($dates)
    {
    
        $this->dates = $dates;
         
        if(!$this->dates)
        {
            $this->dates = array();
        }
        
        
        $serialized = serialize($this->dates);
        
        file_put_contents($this->binFile,$serialized);
        
    }
    
    public function get()
    {
        return unserialize(file_get_contents($this->binFile));
    }
}