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
        $this->isQuizActive();
        $this->questionForHTML();
        $this->userAnswer();
    }
    
    public function renderQuiz()
    {
        $this->lv->RenderLayout($this->qv);
    }
    
    public function isQuizActive()
    {
        $this->qv->isQuizActive($this->qm->isQuizActive());
    }
    
    public function userAnswer()
    {
        if($this->qv->post())
        {
            try
            {
                $this->qm->checkAnswer($this->qv->getAnswer());
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
        
    }
    
    public function questionForHTML()
    {
        $this->qv->setQuestion($this->qm->questionForHTML());
    }


}