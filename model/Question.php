<?php


class Question
{
    private $question;
    private $tips;
    private $correctAnswer;
    
    public function __construct($question, $tips, $correctAnswer)
    {
        $this->question = $question; 
        $this->tips = $tips;
        $this->correctAnswer = $correctAnswer;
    }
    
    public function Question()
    {
        return $this->question;
    }
    
    public function Tips()
    {
        return $this->tips;
    }
    
    public function CorrectAnswer()
    {
        return $this->correctAnswer;
    }
    
}