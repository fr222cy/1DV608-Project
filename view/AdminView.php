<?php


class AdminView
{
private static $password = "AdminView::Password";
private static $login = "AdminView::Login";
private static $logout = "AdminView::Logout";
private static $message;
    public function render()
    {
        
        
        if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"])
        {
         return $this->HTMLAdminPage();    
        }
        else
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
              <a href=?>Back To Login!</a>
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
    
    public function HTMLAdminPage()
    {
           return 
      '
       <div id="head">
            <h1>Admin Page</h1>
       </div>
       
          <h2>Add new Question</h2>
          
           <form method="post" > 
				<fieldset>
			    <p>Some input boxes</p>
				
				</fieldset>
				
			<input type="submit" name="' . self::$logout . '" value="logout" />
			</form>
                  
      ';
    }
    
    public function logout()
    {
        if(isset($_POST[self::$logout]))
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
}