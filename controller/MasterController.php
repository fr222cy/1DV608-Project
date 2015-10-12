<?php
require_once('view/QuizView.php');  
require_once('view/AdminView.php');  
require_once('view/LayoutView.php');  
require_once('view/NavigationView.php');  
require_once('controller/AdminController.php');
require_once('model/LoginModel.php');
  
class MasterController
{
  
    public function init()
    {
        //MODELS
        $loginModel = new LoginModel();
        //VIEWS
        $quizView = new QuizView();
        $navigationView = new NavigationView();
        $layoutView = new LayoutView();
        $adminView =  new AdminView();
        //CONTROLLERS
        $adminController = new AdminController($adminView, $layoutView, $loginModel);
        $page = $navigationView->Navigation();
        
        if($page == "admin")
        {
            $adminController->init();
        }
        else
        {
            $layoutView->RenderLayout($quizView);
        }
    }
    
    
}