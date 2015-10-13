<?php


class AdminView
{

private static $question = "AdminView::Question";
private $tips = "AdminView::Tips";
private static $submit = "AdminView:Submit";
private static $logout = "AdminView::Logout";

    public function render()
    {
        return $this->HTMLAdminPage();    
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
			        <label for="' . self::$question . '">Question :</label>
			        <input type="text" id="' . self::$question . '" name="' . self::$question . '" /> <br>
                    
                    
                    <input type="submit" name="' . self::$submit . '" value="Submit Question" /><br>
				</fieldset>
				
			<input type="submit" name="' . self::$logout . '" value="logout" />
			</form>
                  
      ';
    }
    public function questionPost()
    {
        if(isset($_POST[self::$submit]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
  
    public function getQuestion()
    {
        return $_POST[self::$question];
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