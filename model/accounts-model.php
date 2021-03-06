<?php

// THIS IS THE ACCOUNTS PHP MOTORS MODEL

// THIS FUNCTION WILL HANDLE SITE REGISTRATIONS
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword) values (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)'; 
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    // Replace placeholders in database and report data type
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert data
    $stmt->execute(); 
    // Check for changed rows
    $rowsChanged = $stmt->rowCount();
    // The next line closes the interaction with the database 
    $stmt->closeCursor(); 
    // Return rows changed
    return $rowsChanged;
}

// THIS FUNCTION WILL CHECK FOR EXISTING EMAILS
function checkExistingEmail($clientEmail) {
    $db =  phpmotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($matchEmail)){
     return 0;
    } else {
     return 1;
    }  
}

// Get client data based on an email address
function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }

// Get client data based on an client id
function getClientById($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }

// update the client
function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId) {
    echo $clientFirstname.$clientLastname.$clientEmail.$clientId;
     // Create a connection object from the phpmotors connection function
     $db = phpmotorsConnect(); 
     // The SQL statement
     $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId'; 
     // The next line creates the prepared statement using the phpmotors connection      
     $stmt = $db->prepare($sql);
     // Replace placeholders in database and report data type
     $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
     $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
     $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
     $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
     // Insert data
     $stmt->execute(); 
     // Check for changed rows
     $rowsChanged = $stmt->rowCount();
     // The next line closes the interaction with the database 
     $stmt->closeCursor(); 
     // Return rows changed
     return $rowsChanged;
}

// update the password
function updatePassword($clientPassword, $clientId) {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId'; 
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    // Replace placeholders in database and report data type
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert data
    $stmt->execute(); 
    // Check for changed rows
    $rowsChanged = $stmt->rowCount();
    // The next line closes the interaction with the database 
    $stmt->closeCursor(); 
    // Return rows changed
    return $rowsChanged;
}
?>