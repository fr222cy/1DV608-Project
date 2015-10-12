<?php


class LayoutView
{
    
    public function renderLayout($v)
    {
        echo'<!DOCTYPE html>
          <html>
            <head>
              <meta charset="utf-8">
              <title>Quiz</title>
            </head>
            <body>
            '. $v->render().'
            </body>
          </html>
          ';
        
    }
}