<?php
require_once('model/User.php');
require_once('model/QuizDate.php');
require_once('model/Win.php');

class QuizModel
{
    const DATE_FORMAT = "Y-m-d"; 

    public function __construct(AdminDAL $ad, UserDAL $ud, WinDAL $wd)
    {
        $this->questions = $ad->getQuestions();
        $this->userDAL = $ud;
        $this->winDAL = $wd;
        $this->adminDAL = $ad;
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
            
            //This is quite an "Ugly hack" but it works :)
            if($this->triesLeft <= 0 && !$this->isCorrectAnswer($answer))
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
    
    //Takes in the answer, if it was correct, then remove the question and return true.
    public function checkAnswer($answer)
    {
        $answer = strtolower($answer);
        
        //If the answer is correct, remove the current question
        if($this->isCorrectAnswer($answer))
        {
            $this->adminDAL->removeQuestion();
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function isCorrectAnswer($answer)
    {
        $correctAnswer = null;
        
        //Gets the Correct Answer!
        if(!empty($this->questions))
        {
            $correctAnswer = strtolower($this->questions[0]->CorrectAnswer());
        }    
        
        if($answer == $correctAnswer)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
    //Takes the name, And creates a object of the name and the date of the win.
    //Then saves it to the .bin-file.
    public function closeQuiz($winningName)
    {
        $winObject = new Win($winningName);
        $this->winDAL->save($winObject);
    }
    
    
    public function isQuizWonToday()
    {
        return $this->winDAL->getDay(new DateTime("now")) != null;
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