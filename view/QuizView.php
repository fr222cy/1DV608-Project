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
private static $finished;
private static $user = "user";

     public function __construct()
     {
      
         $this->time = new Timer();
         
         if(!isset($_COOKIE[self::$user]))
         {
            $value = sha1(time());
            setcookie(self::$user , $value , $this->time->CookieExpire(), "/");
         }
      
     }

     public function render()
     {
        if(self::$finished)
        {
           self::$finished = false;
           return $this->HTMLSuccessQuizPage();
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
    
    //if called -> sets finished to true.
    public function QuizFinished()
    {
        self::$finished = true;
    }
    
    //Returns the SuccessPage
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
    //Returns the Open Quiz
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
    
    //Returns the Closed Quiz
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
    
    public function post()
    {
        if(isset($_POST[self::$submitAnswer]))
        {
         
        if(isset($_COOKIE[self::$user]))
        {
            return true;
        }
        
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