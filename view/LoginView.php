<?php


class LoginView
{
private static $password = "AdminView::Password";
private static $login = "AdminView::Login";
private static $message;


     public function render()
     {
         if(!AuthModel::IsAuthorized())
         {
           return $this->HTMLLoginPage();   
         }
           
     }
     
     public function HTMLLoginPage()
     {
      return 
      '
       <div id="head">
            <h1>Admin Login</h1>
       </div>
              
          <div id="LoginArea">
          
          
           <form method="post" > 
           <fieldset>
				<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" /> 
					<input type="submit" name="' . self::$login . '" value="login" />
					'. self::$message .'
			</fieldset>
			</form>
                  
              </div>
              <footer>
              <a href=?>Back To Quiz!</a>
              </footer>
      '; 
    }
    
    public function setMessage($message)
    {
        self::$message = $message;
    }
    
    public function loginPost()
    {
        if(isset($_POST[self::$login]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getPassword()
    {
        return $_POST[self::$password];
    }
    
   
    
}