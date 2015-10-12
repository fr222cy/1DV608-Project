<?php

require_once('controller/MasterController.php');

error_reporting(E_ALL);
ini_set('display_errors', 'On');



$masterController = new MasterController();
$masterController->init();

