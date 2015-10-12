<?php


class AdminController
{
    public function __construct(AdminView $av, LayoutView $lv, LoginModel $lm)
    {
        $this->av = $av;
        $this->lv = $lv;
        $this->lm = $lm;
    }
    
    
    public function init()
    {
        $this->AdminWantsToLogin();
        $this->AdminWantsToLogout();
        $this->lv->RenderLayout($this->av);
    }
    
    public function AdminWantsToLogin()
    {
        if($this->av->loginPost())
        {
            
            try
            {
              $this->lm->checkLogin($this->av->getPassword());
              
            }
            catch(Exception $e)
            {
              $this->av->setMessage($e->getMessage());
            }
        }      
    }
    
    public function AdminWantsToLogout()
    {
        if($this->av->logout())
        {
            $this->lm->logout();
        }
        
    }
}