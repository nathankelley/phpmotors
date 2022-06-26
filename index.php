<?php

// THIS IS THE MAIN CONTROLLER

// Create or access a Session
session_start();

// database connection file
require_once 'library/connections.php';
// PHP Motors model
require_once 'model/main-model.php';
// vehicles model
require_once 'model/vehicles-model.php';
// Get the function library
require 'library/functions.php';

// get the array of classifications
$classifications = getClassifications();
//var_dump($classifications);
    //exit;

// navigation bar using $classifications array
$navList = buildNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}
    
switch ($action) {
    case 'error':
        include 'view/500.php';
        break;

    default:
        include 'view/home.php';
        break;
}

?>