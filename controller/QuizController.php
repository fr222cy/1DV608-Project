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
                if($this->qm->checkAnswer($this->qv->getAnswer()))
                {
                    //Check if the guess was correct, call QuizFinished!
                    $this->qv->QuizFinished();
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


}