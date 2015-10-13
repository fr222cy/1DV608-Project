<?php


class AdminController
{
    public function __construct(AdminView $av, LayoutView $lv, QuizModel $qm)
    {
        $this->av = $av;
        $this->lv = $lv;
        $this->qm = $qm;
    }
    
    
    public function initAdmin()
    {
        //$this->av->questionPost();
        $this->adminLogout();
    }
    
    public function renderAdminPage()
    {
        $this->lv->RenderLayout($this->av);
    }
    
    public function adminAddQuestion()
    {
        
        
    }
    
    public function adminLogout()
    {
        if($this->av->logout())
        {
            AuthModel::Authorize(false);
        }
        
    }
   
}