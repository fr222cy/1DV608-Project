<?php
class QuizView
{
private static $question;  
private static $tips = array();
private static $answer;
private static $submit;
    
    public function render()
    {
     return $this->HTMLQuizPage();
    }
    
    
    public function HTMLQuizPage()
    {
    
     return '
            
              <div id="quizArea">
                  <h3>Question will be here!</h3><br>
                  <label>Tip 1</label><br>
                  <label>Tip 2..</label><br>
                  <label>Enter answer here:</label>
                  
                  <input type="" id="' . self::$answer . '" name="' . self::$answer . '" />
                  <input type="submit" name="' . self::$submit . '" value="Submit Answer" /><br>
                  <label>Next tip: 2h:2min:40sec</label><br>
                  <label>Quiz ends in 10h:2min:40sec</label>
              </div>
              <footer>
              <a href=?admin>Admin Page</a>
              </footer>
                
          
         
        ';
    }
}