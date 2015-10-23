<?php

class QuizView
{
private static $question = "QuizView::Question";  
private static $answer = "QuizView::Answer"; 
private static $tip1 = "QuizView::Tip1"; 
private static $tip2 = "QuizView::Tip2"; 
private static $submitAnswer = "QuizView::SubmitAnswer";  
private static $submitUsername = "QuizView::Username";
private static $message;
private static $correctAnswer;
private static $won;
private static $user = "user";

     public function __construct(WinDAL $winDAL)
     {
      
         $this->time = new Timer();
         
         if(!isset($_COOKIE[self::$user]))
         {
            $value = sha1(time());
            setcookie(self::$user , $value , $this->time->CookieExpire(), "/");
         }
      
     }
     /*
     Returns a page depending on the condition.
     */
   
     public function render()
     {
        if(self::$correctAnswer)
        {
           self::$correctAnswer = false;
           return $this->HTMLSuccessQuizPage();
        }
        
        if(self::$won)
        {
            return $this->HTMLWonQuizPage();
        }
     
        if($this->time->isQuizOpen())
        {
           return $this->HTMLOpenQuizPage();
        }
        
        else
        {
           return $this->HTMLClosedQuizPage();
        }
    }
    
    /*
    If called -> sets finished to true.
    */
    public function userAnsweredRight()
    {
        self::$correctAnswer = true;
    }
    
    public function quizWon()
    {
        self::$won = true;
    }
    
    /*
     HTMLSuccessQuizPage -> Shows that the specific user has won.
     #Input for victoryName
    */
    public function HTMLSuccessQuizPage()
    {
     return '
        <h3>Congratulations!</h3>
        <h4>You Won!</h4>
        
        <p>You were the first one to answer the question correctly today!</p>
        <p>To show you as the winner you have to enter a username.</p>
        
          <form method="post" > 
		   <fieldset>
			  <input type="" id="' . self::$user . '" name="' . self::$user . '" />
              <input type="submit" name="' . self::$submitUsername . '" value="Submit Username" /><br>
           </fieldset>
          </form>
        
        
     ';
    }
     /*
     HTMLWonQuizPage -> Shows that the quiz is Won.
     #Timer to next quiz
     #Displays who won the previous.
    */
    public function HTMLWonQuizPage()
    {
     return '
        <h3>Quiz is won for today!</h3>
        
        ';
    }
    
    /*
    Functions For WinPage
    */
    public function winPost()
    {
        return isset($_POST[self::$submitUsername]);
    }
    
    public function getName()
    {
        return $_POST[self::$user];
    }
    
    /*
     HTMLOpenQuizPage -> Shows that the quiz is open.
     #Questions
     #Tips
     #Input for an answer.
    */
    public function HTMLOpenQuizPage()
    {
    
     return '
              <div id="quizArea">
                  <h3>'.self::$question.'</h3><br>
                  <label>Tip 1: '.self::$tip1.'</label><br>
                  <label>Tip 2: '.self::$tip2.'</label><br>
                  <form method="post" > 
				   <fieldset>
				     <p>'. self::$message .'</p>
                     <input type="" id="' . self::$answer . '" name="' . self::$answer . '" />
                     '. $this->renderSubmit() .'
                     '.$this->renderTriesLeft().'
                   </fieldset>
                  </form>
                  
                  '. $this->quizCloseTimer() .'
              </div>
              <footer>
              <a href=?admin>Admin Page</a>
              </footer>
        ';
    }
    /*
    Functions For HTMLOpenQuizPage
    */
    public function post()
    {
        return isset($_POST[self::$submitAnswer]) && isset($_COOKIE[self::$user]);
    }
    
    public function getAnswer()
    {
        return $_POST[self::$answer];
    }
    
    public function getUserID()
    {
        return $_COOKIE[self::$user];
    }
    
    public function setQuestion($question)
    {
     
        self::$question = $question->Question();
     
        $tips = $question->Tips();
     
        if($this->time->shouldTip1Show())
        {
           self::$tip1 = $tips[0];
        }
        else
        {
           self::$tip1 = " Available at 15:00.";
        }
        
        if($this->time->shouldTip2Show())
        {
           self::$tip2 = $tips[1];
        }
        else
        {
           self::$tip2 = " Available at 18:00.";
        }
     
    }
    
       
    public function triesLeft($amount)
    {
       $this->triesLeft = $amount;
    }
    
    public function renderTriesLeft()
    {
       
        if($this->triesLeft <=0 && !is_null($this->triesLeft))
        {
            return '<p> You have 0 tries left</p>';
        }
        else if(!is_null($this->triesLeft))
        {
            return '<p> You have '.$this->triesLeft.' tries left</p>';
        }
        else
        {
            return '';
        }
    }
    
    public function renderSubmit()
    {
        if($this->triesLeft <= 0 && !is_null($this->triesLeft))
        {
            return '
            <input type="submit" name="' . self::$submitAnswer . '" value="Submit Answer" disabled/><br>
            ';
        }
        else
        {
           return  '
            <input type="submit" name="' . self::$submitAnswer . '" value="Submit Answer" /><br>
            '; 
        }
        
    }
 
    /*
     HTMLClosedQuizPage -> Shows that the quiz is closed.
     #Timer till quiz is open.
    */
    public function HTMLClosedQuizPage()
    {
    
     return '
            
              <div id="quizArea">
              <h2>The Quiz is currently closed</h2>
              <h3>The quiz is open between 12:00 and 00:00 (Central European Time)</h3>
              <h3>Last Winner: ---- </h3>
              <h5>'. $this->quizOpenTimer() .'</h5>
              </div>
              <footer>
              <a href=?admin>Admin Page</a>
              </footer>
        ';
    }
    
    /*
    SetMessage Functions
    */
    public function setMessage($message)
    {
        self::$message = $message;
    }
    public function wrongAnswer()
    {
        $this->setMessage("Ouch! Wrong answer.");
    }
    
    public function noMoreAttempts()
    {
        $this->setMessage("You are out of attempts for today.<br> Come back tomorrow at 12:00!");
    }
    
    /*
    Countdown Functions in javaScript(using Countdown.js)
    */
    public function quizCloseTimer()
    {
     return
     ' 
      The Quiz will close in <span id="countdown-holder"/>
      <script>
      var clock = document.getElementById("countdown-holder")
      , targetDate = new Date();
       targetDate.setHours(24);
       targetDate.setMinutes(0);
       targetDate.setSeconds(0);
       
      clock.innerHTML = countdown(targetDate).toString();
      setInterval(function(){
      clock.innerHTML = countdown(targetDate).toString();
      }, 1000);
      </script>
     ';
    }
    
    public function quizOpenTimer()
    {
     return
     ' 
      The Quiz will open in <span id="countdown-holder"/>
      <script>
      var clock = document.getElementById("countdown-holder")
      , targetDate = new Date();
       targetDate.set
       targetDate.setHours(12+24);
       targetDate.setMinutes(0);
       targetDate.setSeconds(0);
       
      clock.innerHTML = countdown(targetDate).toString();
      setInterval(function(){
      clock.innerHTML = countdown(targetDate).toString();
      }, 1000);
      </script>
     ';
    }
}