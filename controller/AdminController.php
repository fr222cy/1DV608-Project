<?php


class AdminController
{
    public function __construct(AdminView $av, LayoutView $lv, QuestionModel $qm, AdminDAL $ad)
    {
        $this->av = $av;
        $this->lv = $lv;
        $this->qm = $qm;
        $this->ad = $ad;
    }
    
    
    public function initAdmin()
    {
        $this->adminAddQuestion();
        $this->adminLogout();
      
    }
    
    public function renderAdminPage()
    {
        $this->lv->RenderLayout($this->av);
    }
    
    public function adminAddQuestion()
    {
        
        if($this->av->questionPost())
        {
          
          try
          {
            $questionObject = $this->qm->checkQuestion($this->av->getQuestion(), $this->av->getTips(), $this->av->getAnswer());  
            $this->ad->saveQuestion($questionObject);
            $this->av->printSuccess();
            
          }
          catch(Exception $e)
          {
              $this->av->setMessage($e->getMessage());
          }
            
        }
        
    }
    
    public function adminLogout()
    {
        if($this->av->logout())
        {
            AuthModel::Authorize(false);
        }
        
    }
    
   
}