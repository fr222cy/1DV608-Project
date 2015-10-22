<?php



class User
{
    private $tries;
    private $userID;
    
    public function __construct($userID, $tries)
    {
        $this->userID = $userID;
        $this->tries = $tries;
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
        $this->tries--;
    }
  
    
}