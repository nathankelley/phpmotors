<?php

// THIS IS THE VEHICLES CONTROLLER

// Create or access a Session
session_start();

// database connection file
require '../library/connections.php';
// PHP Motors model
require '../model/main-model.php';
// vehicles model
require_once '../model/vehicles-model.php';
// Get the function library
require '../library/functions.php';

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


switch ($action) {
    case 'error':
        include '../view/500.php';
        break;
    case 'add-classification':
        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Check for missing data
        if(empty($classificationName)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = regClassification($classificationName);
        if ($regOutcome === 1) {
            header("Location: /phpmotors/vehicles");
        } else {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }
        break;

    case 'add-vehicle':
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_URL));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
        exit;
        }

         // Send the data to the model
         $regOutcome = regInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

         // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Vehicle registered.</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Sorry, registration failed. Please exit and try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }

        break;
    default:
        include '../view/vehicle-management.php';
        break;
}

?>