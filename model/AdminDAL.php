<?php

/*
*Saves Questions
*Gets Questions
*/
class AdminDAL
{
    
    private $questionObject;
   
    public function __construct()
    {
        $this->questions = array();
        $this->binFile = 'data/questions.bin';
    }
    
    public function saveQuestion($questionObject)
    {
        $this->questions = $this->getQuestions();
        
        if(!$this->questions)
        {
            $this->questions = array();
        }
        
        array_push($this->questions,$questionObject);
        $serialized = serialize($this->questions);
        
        file_put_contents($this->binFile,$serialized);
    }
    
    public function removeQuestion($answer)
    {
        $this->questions = $this->getQuestions();
        array_shift($this->questions);
        $serialized = serialize($this->questions);
        file_put_contents($this->binFile,$serialized);
    }
    
    public function getQuestions()
    {
        return unserialize(file_get_contents($this->binFile));
    }
    
    
    
    
}