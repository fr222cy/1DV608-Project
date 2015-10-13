<?php
require_once('model/Question.php');

class QuizModel
{

    public function checkQuestion($question, $tips)
    {
        
        if(strlen($question) < 5)
        {
            throw new Exception("The Question must have 5 or more Characters!");
        }
        if(substr($question, -1) != "?")
        {
            throw new Exception("The Question must end with a Question Mark!");
        }
        
        if(empty($tips[0]) || empty($tips[1]))
        {
            throw new Exception("You must give the users hints!");
        }
        
        $questionObject = new Question($question, $tips);
        
        return $questionObject;

        
    }
}