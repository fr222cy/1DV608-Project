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
    }
    
    public function renderQuiz()
    {
        $this->lv->RenderLayout($this->qv);
    }
    
    public function userAnswer()
    {
        if($this->qv->post())
        {
            try
            {
                $this->qm->canGuess($this->qv->getUserID());
                if($this->qm->checkAnswer($this->qv->getAnswer()))
                {
                    $this->qv->isQuizFinished();
                }
                
            }
            catch(Exception $e)
            {
                //The User made a guess, save it.
                
                $this->qv->setMessage($e->getMessage());
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


}