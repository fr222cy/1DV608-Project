<?php

class QuizController
{

    public function __construct(QuizView $qv, LayoutView $lv , QuizModel $qm)
    {
        $this->qv = $qv;
        $this->lv = $lv;
        $this->qm = $qm;
    }
    
    public function init()
    {
        $this->isWon();
        $this->questionForHTML();
        $this->userAnswer();
        $this->triesLeftForHTML();
        
    }
    
    public function renderQuiz()
    {
        $this->lv->RenderLayout($this->qv);
    }
    
    public function userAnswer()
    {
        if($this->qv->post())
        {
            
            //The User made a guess, save it.
            if($this->qm->canGuess($this->qv->getUserID(), $this->qv->getAnswer()))
            {   
                //Check if the answer was correct!
                if($this->qm->checkAnswer($this->qv->getAnswer()))
                {
                    
                    $this->qv->userAnsweredRight();
                } 
                else
                {
                    $this->qv->wrongAnswer();
                }
            }
            else
            {
                $this->qv->noMoreAttempts();
            }
        }
    }
    
    public function questionForHTML()
    {
        try
        {
         $this->qv->setQuestion($this->qm->questionForHTML());   
        }
        catch(Exception $e)
        {
            $this->qv->setMessage($e->getMessage());
        }
    }
    //Gets triesLeft from model, send it to the view.
    public function triesLeftForHTML()
    {
        $this->qv->triesLeft($this->qm->getTriesToHTML());
    }
    
 
    public function isWon()
    {
        //Has the user has typed in a name after winning?.
        if($this->qv->winPost())
        {
            //Then Close the quiz.
            $this->qm->closeQuiz($this->qv->getName());
        }
        
        elseif ($this->qm->isQuizWonToday())
        {
            $this->qv->quizWon();
        }
        
    }
}