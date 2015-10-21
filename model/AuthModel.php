<?php


class AuthModel
{
 
    public static function Authorize($isLoggedIn)
    {
        if($isLoggedIn)
        {
            $_SESSION['LoggedIn'] = true;
        }
        else
        {
            $_SESSION['LoggedIn'] = false;
        }
    }
    public static function IsAuthorized()
    {
    if(isset($_SESSION['LoggedIn']))
    {
       if($_SESSION['LoggedIn'])
        {
            return true;    
        }
        else
        {
           return false; 
        }  
    }
       
    }
    
    
}