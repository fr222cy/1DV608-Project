<?php


class LayoutView
{
    
    public function renderLayout($v)
    {
        echo'<!DOCTYPE html>
          <html>
            <head>
              <link href="style/hover.css/css/hover-min.css" rel="stylesheet">
              <link rel="stylesheet" type="text/css" href="style/main.css">
              <script src="misc/countdown.js"></script>
              <meta charset="utf-8">
              <title>Quiz</title>
            </head>
            
            
            <body>
            
            <div id="container">
              <img src="style/your-daily-quiz.png"></img>
            
              '. $v->render().'
            </div>
            </body>
          </html>
          ';
        
    }
}