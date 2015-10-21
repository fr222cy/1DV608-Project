<?php



class User
{
    private $tries;
    private $userID;
    
    public function __construct($userID)
    {
        $this->userID = $userID;
        $this->tries = 3;
        
    }
    
    public function getUserID()
    {
        return $this->userID;
    }
    
    public function getTries()
    {
        return $this->tries;
    }
    
    public function reduceTriesByOne()
    {
        $this->tries -1;
    }
    
}