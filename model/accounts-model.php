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

?>