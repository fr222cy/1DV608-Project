<?php
session_start();


class LoginModel
{
    
    public function __construct()
    {
        if(!isset($_SESSION["isLoggedIn"]))
        {
            $_SESSION["isLoggedIn"] = false;
        }
        
    }
    
    public function checkLogin($password)
    {
        
        
        $correctPW = "kiosk";
        
        if($correctPW == $password)
        {
            $_SESSION["isLoggedIn"] = true;
            return true;
        }
        else 
        {
            throw new Exception("Wrong Password!");
        }
    }
    
    public function logout()
    {
        $_SESSION["isLoggedIn"] = false;
        unset($_SESSION["isLoggedIn"]);
    }
    
    
}