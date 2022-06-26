<?php

// ACCOUNTS CONTROLLER

// Create or access a Session
session_start();

// database connection file
require '../library/connections.php';
// PHP Motors model
require '../model/main-model.php';
// accounts model
require '../model/accounts-model.php';
// Get the function library
require '../library/functions.php';

// get the array of classifications
$classifications = getClassifications();
//var_dump($classifications);
    //exit;

// navigation bar using $classifications array
$navList = buildNavList($classifications);


$clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
$clientLastname = filter_input(INPUT_POST, 'clientLastname');
$clientEmail = filter_input(INPUT_POST, 'clientEmail');
$clientPassword = filter_input(INPUT_POST, 'clientPassword');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Check that the email and password are valid
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for existing email address
        $existingEmail = checkExistingEmail($clientEmail);
        if($existingEmail) {
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }
        
        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
        exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if($regOutcome === 1){
            // SET COOKIES
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }

        break;
    case 'Login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        if(empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide a valid email address and password.</p>';
            include '../view/login.php';
        exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);

        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;

        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);

        // Store the array into the session
        $_SESSION['clientData'] = $clientData;

        // Send them to the admin view
        include '../view/admin.php';
        exit;

        break;
    case 'Logout':
        // Set loggedin value to false, header will change
        $_SESSION['loggedin'] = FALSE;

        // Set session data to unset
        session_unset();
        // Destroy session
        session_destroy();
        include '../view/home.php';
        break;
    case 'client-update':
        include '../view/client-update.php';
        break;
    case 'account-update':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        // Check that the email and password are valid
        $clientEmail = checkEmail($clientEmail);

        // Check for existing email address
        $existingEmail = checkExistingEmail($clientEmail);
        if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
            if($existingEmail) {
                $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
        exit;
        }

        // Send the data to the model
        $regOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check and report the result
        if($regOutcome === 1){
            // get clientData by id
            $clientData = getClientById($clientId);
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;

            // update message
            $_SESSION['message'] = "<p>Thanks for updating your information $clientFirstname.";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    case 'password-change':
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        
        $checkPassword = checkPassword($clientPassword);

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model
        $regOutcome = updatePassword($hashedPassword, $clientId);
        if($regOutcome === 1){
            // get clientData by id
            $clientData = getClientById($clientId);
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;

            $_SESSION['message'] = "<p>Thanks for updating your information $clientFirstname.";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    case 'home':
        include '/phpmotors/view/home.php';
        break;
    case 'error':
        include '/phpmotors/view/500.php';
        break;
    default:
        include '../view/admin.php';
        break;
}

?>