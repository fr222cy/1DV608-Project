<?php


class Question
{
    private $question;
    
    public function __construct($question)
    {
        $this->question = $question; 
    }
    
    public function getQuestion()
    {
        return $this->question;
    }
    
}