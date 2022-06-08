<?php

// THIS IS THE MAIN CONTROLLER

// database connection file
require_once 'library/connections.php';
// PHP Motors model
require_once 'model/main-model.php';

// get the array of classifications
$classifications = getClassifications();
//var_dump($classifications);
    //exit;

// navigation bar using $classifications array
$navList = '<ul id="nav">';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
//echo $navList;
//exit;

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
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