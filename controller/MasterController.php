<?php
require_once('view/QuizView.php');  
require_once('view/AdminView.php');  
require_once('view/LayoutView.php');  
require_once('view/NavigationView.php');  
require_once('view/LoginView.php');
require_once('controller/AdminController.php');
require_once('controller/LoginController.php');
require_once('controller/QuizController.php');
require_once('model/LoginModel.php');
require_once('model/AuthModel.php');
require_once('model/QuestionModel.php');
require_once('model/AdminDAL.php');
require_once('model/QuizModel.php');

class MasterController
{
 
    public function init()
    {
        //MODELS
        $loginModel = new LoginModel();
        $questionModel = new QuestionModel();
        $adminDAL = new AdminDAL();
        $quizModel = new QuizModel($adminDAL);
        //VIEWS
        $quizView = new QuizView();
        $navigationView = new NavigationView();
        $layoutView = new LayoutView();
        $adminView =  new AdminView($adminDAL);
        $loginView = new LoginView();
        //CONTROLLERS
        $adminController = new AdminController($adminView, $layoutView, $questionModel, $adminDAL);
        $loginController = new LoginController($loginView, $layoutView, $loginModel, $adminController);
        $quizController = new QuizController($quizView, $layoutView, $quizModel, $adminDAL);
        
        
        $page = $navigationView->Navigation();
        
        if($page == "admin")
        {
            $loginController->initLogin();
            $adminController->initAdmin();
            
            if(AuthModel::IsAuthorized())
            {
             $adminController->renderAdminPage();
            }
            else
            {
             $loginController->renderLogin();
            }
        }
        else
        {
            $quizController->init();
            $quizController->renderQuiz();
            
        }
    }
    
    
}