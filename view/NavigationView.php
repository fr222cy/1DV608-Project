<?php

class NavigationView
{


    public function Navigation()
    {
       if(isset($_GET["admin"]))
       {
           return "admin";
       }
       else 
       {
           return "?";
       }
        
    }
    
    
    
}