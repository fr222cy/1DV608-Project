<?php
class QuizView
{
private static $question = "QuizView::Question";  
private static $answer = "QuizView::Answer"; 
private static $tip1 = "QuizView::Tip1"; 
private static $tip2 = "QuizView::Tip2"; 
private static $submitAnswer = "QuizView::SubmitAnswer";  
private static $message;


    public function render()
    {
     
     if($this->active)
     {
      return $this->HTMLOpenQuizPage();
     }
     else
     {
      return $this->HTMLClosedQuizPage();
     }
    }
    
    public function isQuizActive($active)
    {
     $this->active = $active;
    }
    
    
    public function HTMLOpenQuizPage()
    {
    
     return '
              <div id="quizArea">
                  <h3>'.self::$question.'</h3><br>
                  <label>Tip 1: '.self::$tip1.'</label><br>
                  <label>Tip 2: '.self::$tip2.'</label><br>
                  <form method="post" > 
				              <fieldset>
                  <input type="" id="' . self::$answer . '" name="' . self::$answer . '" />
                  <input type="submit" name="' . self::$submitAnswer . '" value="Submit Answer" /><br>
                  </fieldset>
                  </form>
                  <label>Next tip: 2h:2min:40sec</label><br>
                  <label>Quiz ends in 10h:2min:40sec</label>
              </div>
              <footer>
              <a href=?admin>Admin Page</a>
              </footer>
        ';
    }
     public function HTMLClosedQuizPage()
    {
    
     return '
            
              <div id="quizArea">
              <h2>The Quiz is currently closed</h2>
              <h3>The quiz is open between 12pm and 22pm</h3>
              <h3>Last Winner: ---- </h3>
              </div>
              <footer>
              <a href=?admin>Admin Page</a>
              </footer>
                
        ';
    }
    
    public function post()
    {
     
        if(isset($_POST[self::$submitAnswer]))
        {
    
        return true;
        }
        else
        {
        return false;
        }
    }
    
    public function getAnswer()
    {
     return $_POST[self::$answer];
    }
    
    public function setQuestion($question)
    {
     
     self::$question = $question->Question(); 
     
     $tips = $question->Tips();
     
     self::$tip1 = $tips[0];
     self::$tip2 = $tips[1];
   
     
     
    }
}