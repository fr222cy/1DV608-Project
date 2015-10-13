<?php


class Question
{
    private $question;
    private $tips;
    
    public function __construct($question, $tips)
    {
        $this->question = $question; 
        $this->tips = $tips;
    }
    
    public function getQuestion()
    {
        return $this->question;
    }
    
    public function getTips()
    {
        return $this->tips;
    }
    
}