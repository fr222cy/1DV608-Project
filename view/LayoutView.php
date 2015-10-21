<?php


class LayoutView
{
    
    public function renderLayout($v)
    {
        echo'<!DOCTYPE html>
          <html>
            <head>
              
              <script src="misc/countdown.js"></script>
              <meta charset="utf-8">
              <title>Quiz</title>
            </head>
            <body>
            <h1>Your Daily Quiz</h1>
            '. $v->render().'
            </body>
          </html>
          ';
        
    }
}