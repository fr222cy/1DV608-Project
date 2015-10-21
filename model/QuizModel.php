<?php
require_once('model/User.php');
require_once('model/QuizDate.php');
class QuizModel
{
    const DATE_FORMAT = "Ymd"; 

    public function __construct(AdminDAL $ad)
    {
        $this->userDAL = new UserDAL();
        $this->questions = $ad->getQuestions();
        $this->ad = $ad;
    }
    
    public function canGuess($userID)
    {
        //Retrieve all Dates with users
        $dates = $this->userDAL->get();
        
        if(!$dates)
        {
            $dates = array();   
        }
        
        //if it doesnt exist a date on this day -> create one.
        if(!isset($dates[$this->getDate()])){
            $today = new QuizDate($this->getDate());
            $dates[$this->getDate()] = $today;
        }
        
        $today = $dates[$this->getDate()];
        $users = $today->getUsers();
        
        //check if the user exist, else create a new user.
        if(isset($users[$userID]))
        {
            echo "OLD USER";
            $user = $users[$userID];   
            $user->reduceTriesByOne();
            echo "<br>user has ".$user->getTries(). "tries";
            $users[$user->getUserID()] = $user;
            
        }
        else
        {
            echo "CREATE NEW USER";
            
            $user = new User($userID);
            $users[$user->getUserID()] = $user;
        }
        $today->setUsers($users);
        $dates[$today->getQuizTime()] = $today;
        var_dump($dates);
        
        $this->userDAL->save($dates);
        
    }
    
    public function getDate()
    {
        return date(self::DATE_FORMAT);    
    }
    
    public function checkAnswer($answer)
    {
        $answer = strtolower($answer);
        $correctAnswer = null;
        
        if(!empty($this->questions))
        {
        $correctAnswer = strtolower($this->questions[0]->CorrectAnswer());
        }    
    
        if($answer == $correctAnswer)
        {
            $this->ad->removeQuestion($answer);
            return true;
        }
        else
        {
            
            throw new Exception("Ouch! Wrong Answer.");
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