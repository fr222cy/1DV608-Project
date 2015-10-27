<?php
require_once('model/Question.php');

class QuestionModel
{

    public function checkQuestion($question, $tips, $correctAnswer)
    {
        
        if(strlen($question) < 5)
        {
            throw new Exception("The question must have 5 or more characters.");
        }
          if(strlen($correctAnswer) < 1)
        {
            throw new Exception("The answer must have more than 0 characters.");
        }
        if(substr($question, -1) != "?")
        {
            throw new Exception("The question must end with a question mark.");
        }
        
        if(empty($tips[0]) || empty($tips[1]))
        {
            throw new Exception("No tip was given.");
        }
        
        if($question != strip_tags($question)
        || $correctAnswer != strip_tags($correctAnswer)
        || $tips[0] != strip_tags($tips[0])
        || $tips[1] != strip_tags($tips[1]))
        {
           throw new Exception("No Tags >:("); 
        }
        
        $questionObject = new Question($question, $tips, $correctAnswer);
        
        return $questionObject;

        
    }
}