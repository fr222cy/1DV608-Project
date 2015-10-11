<?php

class QuizView
{
private static $question;  
private static $tips = array();
private static $answer;
private static $submit;


    public function renderQuizPage()
    {
    
     echo '<!DOCTYPE html>
          <html>
            <head>
              <meta charset="utf-8">
              <title>Quiz</title>
            </head>
            <body>
            
              <div id="head">
                <h1>Daily Quiz (mock-up)</h1>
              </div>
              
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
              <a href=?Admin-Page>Admin Page</a>
              </footer>
                
             </body>
          </html>
        ';
    }
}
