<?php


class QuizDate
{
    private $users;
    private $quizTime;

    public function __construct($date, $users = null)
    {
        $this->users = ($users != null) ? $users : array();
        $this->quizTime = $date;
    }
    
    public function getUsers()
    {
        return $this->users;
    }
    
    public function setUsers($users)
    {
        $this->users = $users;
    }
    
    public function getQuizTime()
    {
        return $this->quizTime;
    }

}
    
