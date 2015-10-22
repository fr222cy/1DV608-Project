<?php
require_once('model/User.php');
require_once('model/QuizDate.php');
class QuizModel
{
    const DATE_FORMAT = "Y-m-d"; 

    public function __construct(AdminDAL $ad, UserDAL $ud)
    {
        $this->userDAL = $ud;
        $this->questions = $ad->getQuestions();
        $this->ad = $ad;
        $this->triesLeft = null;
    }
    public function getDate()
    {
        return date(self::DATE_FORMAT);    
    }
    public function canGuess($userID, $answer)
    {
        //Retrieve all Dates with users
        $dates = $this->userDAL->get();
        
        if(!$dates)
        {
            $dates = array();   
        }
        
        //If it doesnt exist a date on this day -> create one.
        if(!isset($dates[$this->getDate()])){
            $today = new QuizDate($this->getDate());
            $dates[$this->getDate()] = $today;
        }
        
        $today = $dates[$this->getDate()];
        $users = $today->getUsers();
        
        //Check if the user exist and reduce tries, else create a new user.
        if(isset($users[$userID]))
        {
            $user = $users[$userID];
          
            $user->reduceTriesByOne();
            
            $this->triesLeft = $user->getTries();
            
            //This is quite an "Ugly hack" but it works.
            if($this->triesLeft <= 0 && !$this->checkAnswer($answer))
            {
                return false;
            }
            
            $users[$user->getUserID()] = $user;
        }
        else
        {
            $tries = 2;
            $user = new User($userID, $tries);
            $this->triesLeft = $user->getTries();
           
            $users[$user->getUserID()] = $user;
        }
        
        $today->setUsers($users);
        $dates[$today->getQuizTime()] = $today;
        
        //Save everything to the .bin-file
        $this->userDAL->save($dates);
        return true;
    }
    public function getTriesToHTML()
    {
        return $this->triesLeft;
    }
    public function checkAnswer($answer)
    {
        $answer = strtolower($answer);
        $correctAnswer = null;
        
        //Gets the Correct Answer!
        if(!empty($this->questions))
        {
        $correctAnswer = strtolower($this->questions[0]->CorrectAnswer());
        }    
        
        //If the answer is correct, remove the current question
        if($answer == $correctAnswer)
        {
            $this->ad->removeQuestion();
            return true;
        }
        else
        {
            return false;
        }
    }
    public function questionForHTML()
    { 
        if(!empty($this->questions))
        {
           return $this->questions[0];
        }
        throw new Exception("No question available.");
    }
    
}