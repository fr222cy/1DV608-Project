<?php
session_start();


class LoginModel
{
    
    
    public function checkLogin($password)
    {
        $correctPW = "kiosk";
        
        if($correctPW == $password)
        {
            AuthModel::Authorize(true);
            return true;
        }
        else 
        {
            throw new Exception("Wrong Password!");
        }
    }
    
}