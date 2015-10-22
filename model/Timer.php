<?php


class Timer
{
    private $hour;
    private $minute;
    private $second;
    private $hourOpen;
    private $hourClose;
    private $minuteClose;
    private $secondClose;
    private $tip1Show;
    private $tip2Show;
    
    
    public function __construct()
    {
        /*The Current time*/
        date_default_timezone_set("Europe/Stockholm");
        
        $this->hour = idate('H');
        $this->minute = idate('i');
        $this->second = idate('i');
        
        /*Quiz Opens at 12:00:00 and closes at 23:59:59*/
        $this->hourOpen = 12;
        $this->hourClose = 23;
        $this->minuteClose = 59;
        $this->secondClose= 59;
        /*First tip at 15:00 , Second tip at 18:00*/
        $this->tip1Show = 15;
        $this->tip2Show = 18;
    }
    
    public function isQuizOpen()
    {
        
      if($this->hour >= $this->hourOpen &&
         $this->hour <= $this->hourClose &&
         $this->minute <= $this->minuteClose && 
         $this->second <= $this->secondClose)
      {
          return true;
      }
      else
      {
          return false;
      }
      
    }

    
    public function shouldTip1Show()
    {
         if($this->hour >= $this->tip1Show &&
         $this->tip1Show <= $this->hourClose &&
         $this->minute <= $this->minuteClose && 
         $this->second <= $this->secondClose)
         {
            return true;
         }
         else
         {
            return false;
         }
            
    }
    
    public function shouldTip2Show()
    {
         if($this->hour >= $this->tip2Show &&
         $this->tip2Show <= $this->hourClose &&
         $this->minute <= $this->minuteClose && 
         $this->second <= $this->secondClose)
         {
            return true;
         }
         else
         {
            return false;
         }
    }
    
    public function CookieExpire()
    {
        $hoursToOpen = ($this->hourClose + 1) - $this->hour + $this->hourOpen;
        
        $date = new DateTime("now");
        var_dump($date);
        $date->add(new DateInterval("P1D"));
        $date->setTime(12,0,0);
        
        
        return $date->format("U"); //idate('U') + ($hoursToOpen * 3600);
    }
     
}