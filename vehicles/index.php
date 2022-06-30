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

$classificationList = buildClassificationList($classifications);


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
    case 'getInventoryItems':
        // Get the classificationId
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back
        echo json_encode($inventoryArray);
        break;
    case 'mod': 
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
           }
        include '../view/vehicle-update.php';
        exit;

        break;
    case 'updateVehicle':
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invId= filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);


        // Check for missing data
        if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p>Please complete all information for the new item! Double check the classification of the item.</p>';
            include '../view/vehicle-update.php';
        exit;
        }

         // Send the data to the model
         $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

         // Check and report the result
        if($updateResult){
            $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Error. the $invMake $invModel was not updated.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);

        $classificationList = buildClassificationList($classifications);

        if (count($invInfo) < 1) {
		$message = 'Sorry, no vehicle information could be found.';
	    }
	    include '../view/vehicle-delete.php';
	    exit;   
        break;
    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'msg':
        $message = "something";
        include '../view/vehicle-management.php';
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);

        if(!count($vehicles)) {
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        
        include '../view/classification.php';
        break;
    case 'vehicle-detail':
        

        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $vehicle = getInvItemInfo($invId);

        if(empty($vehicle)) {
            $message = "<p class='notice'>Sorry, no vehicle could be found.</p>";
        } else {
            $vehicleDisplay = buildSpecificVehicleDisplay($vehicle);
        }
        
        include '../view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);  
        include '../view/vehicle-management.php';
        break;
}

?>