<?php


class AdminView
{

private static $question = "AdminView::Question";
private static $submit = "AdminView::Submit";
private static $logout = "AdminView::Logout";
private static $tip1 = "AdminView::Tip1";
private static $tip2 = "AdminView::Tip2";
private static $showQuestions = "AdminView::ShowQuestions";
private static $message = "";

    public function __construct(AdminDAL $ad)
    {
        $this->ad = $ad;
    }

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
			        <p>'. self::$message .'</p>
			        <label for="' . self::$question . '">Question :</label>
			        <input type="text" id="' . self::$question . '" name="' . self::$question . '" /> <br>
                    
                    <label for="' . self::$tip1 . '">Tip 1 :</label>
			        <input type="text" id="' . self::$tip1 . '" name="' . self::$tip1 . '" /> <br>
			        
			        <label for="' . self::$tip2 . '">Tip 2 :</label>
			        <input type="text" id="' . self::$tip2 . '" name="' . self::$tip2 . '" /> <br>
                    
                    <input type="submit" name="' . self::$submit . '" value="Submit Question" /><br>
                    <br>
				</fieldset>
				
			<input type="submit" name="' . self::$logout . '" value="Logout" />
			<input type="submit" name="' . self::$showQuestions . '" value="Show Questions" />
			
			
			</form>
            '. $this->showQuestions() .'  
      ';
    }
    
    public function setMessage($message)
    {
        self::$message = $message;
    }
    
    public function printSuccess()
    {
        self::$message = "The question was successfully saved.";
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
    
    public function getTips()
    {
        $tip1 = $_POST[self::$tip1];
        $tip2 = $_POST[self::$tip2];
        
        $tips = array($tip1,$tip2);
        
        return $tips;
        
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
    
    public function showQuestions()
    {
        //WOW YOU ARE SO SMART PHILIP!
        //HOW DID U COME UP WITH THIS?!!!
        
        if(isset($_POST[self::$showQuestions]))
        {
            $questions = $this->ad->GetQuestions();
            
            $htmlStart = '<table>';
            
            foreach($questions as $question)
            {
                $htmlpreMid .= '
                <tr>
                <td>'.$question->getQuestion().'</td>';
                
                foreach ($question->getTips() as $tip)
                {
                $htmlMid .= '<td>'.$tip.'</td>';
                }
                
                $htmlMidend .= '</tr>';
            }
           $htmlEnd = '</table>';
            return $htmlStart.=$htmlpreMid.=$htmlMid.=$htmlMidend.=$htmlEnd;
        }
    }
}