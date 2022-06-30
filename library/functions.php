<?php

function write_to_console($data) {

    $console = 'console.log(' . json_encode($data) . ');';
    $console = sprintf('<script>%s</script>', $console);
    echo $console;
   }


// A library of custom functions for our code to perform a variety of tasks //


// VALIDATE EMAIL
function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// VALIDATE PASSWORD
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

// BUILD THE NAVIGATION LIST    
function buildNavList($classifications) {
    $navList = '<ul id="nav">';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li>
        <a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName']).
        "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a>
        </li>";
    }
    $navList .= '</ul>';

    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }


// THIS FUNCTION WILL BUILD A DISPLAY OF VEHICLES
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<a href="/phpmotors/vehicles/index.php?action=vehicle-detail&invId='.urlencode($vehicle['invId']).'">';
     $dv .= '<div class="vehicle-div">';
     $dv .= '<li>';
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= "<span>Price: $$vehicle[invPrice]</span>";
     $dv .= '</li>';
     $dv .= '</div>';
     $dv .= '</a>';
    }
    $dv .= '</ul>';
    return $dv;
   }

// THIS FUNCTION WILL DISPLAY VEHICLE INFO
function buildSpecificVehicleDisplay($vehicle) {
    $dv = '<div id="vehicle-display"';
        $dv .= "<div id='display-child-left'>";
        $dv .= "<figure>";
        $dv .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com' class='specific-vehicle-image'>";
        $dv .= "<figcaption><strong>Price: $$vehicle[invPrice]</strong></figcaption>";
        $dv .= "</figure>";
        $dv .= "</div>";
        $dv .= "<div id='display-child-right'>";
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<p>$vehicle[invDescription]</p>";
        $dv .= "<h3>Color: $vehicle[invColor]</h3>";
        $dv .= "<h3># in Stock: $vehicle[invStock]</h3>";
        $dv .= "</div>";
       
       $dv .= '</div>';
       return $dv;
}
?>