<?php

class LoginController
{
    public function __construct(LoginView $loginView, LayoutView $lv, LoginModel $lm)
    {
        $this->loginView = $loginView;
        $this->lv = $lv;
        $this->lm = $lm;
    }
    
    
    public function initLogin()
    {
        $this->adminWantsToLogin();
    }
    
    public function renderLogin()
    {
        $this->lv->RenderLayout($this->loginView);
    }
    
    public function adminWantsToLogin()
    {
        if($this->loginView->loginPost())
        {
            try
            {
             $this->lm->checkLogin($this->loginView->getPassword());
            }
            catch(Exception $e)
            {
              $this->loginView->setMessage($e->getMessage());
             
            }
        }      
    }
}