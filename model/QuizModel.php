<?php


class QuizModel
{
    
    public function __construct(AdminDAL $ad)
    {
        
        $this->questions = $ad->getQuestions();
        $this->ad = $ad;
         
    }
    
    public function isQuizActive()
    {
        date_default_timezone_set("Europe/Stockholm");
        
        
        /*Quiz Opens at 12pm and closes at 22pm*/
        $hourClose = 22;
        $hourOpen = 12;
        $hour = idate('H');
        
        
        if($hour >= $hourOpen && $hour < $hourClose)
        {
            return true;
        }
        else
        {
            return false;
        }
        
        
    }
    
    public function checkAnswer($answer)
    {
        $answer = strtolower($answer);
        $correctAnswer = strtolower($this->questions[0]->CorrectAnswer());
        
        
        if($answer == $correctAnswer)
        {
            $this->ad->removeQuestion($answer);
            echo 'Correct jao';
        }
        else
        {
            throw new Exception("Ouch! Wrong Answer.");
        }
        
        
    }
    
    public function questionForHTML()
    {
        //return the first question in the question array!
        //FIX TIPS DATE
        
        
        return $this->questions[0];
    }
    
}