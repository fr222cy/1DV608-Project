<?php
require_once('view/QuizView.php');


error_reporting(E_ALL);
ini_set('display_errors', 'On');

$qv = new QuizView();


$qv->renderQuizPage();