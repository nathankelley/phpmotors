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
     $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2 class='vehicle-list-makeModel'>$vehicle[invMake] $vehicle[invModel]</h2>";
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
    $dv = '<div id="details-display">';
        $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com' class='specific-vehicle-image'>";
        $dv .= "<h4>Price: $$vehicle[invPrice]</h4";  
    $dv .= "</div>";
    $dv .= "<div id='display-child-right'>";
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<p>$vehicle[invDescription]</p>";
        $dv .= "<h3>Color: $vehicle[invColor]</h3>";
        $dv .= "<h3># in Stock: $vehicle[invStock]</h3>";
    $dv .= "</div>";
    return $dv;
}


// THIS FUNCTION WILL DISPLAY THUMBNAILS
function displayThumbnails($thumbnails) {
    $dv = "<div id='thumbnail-display'";
    foreach ($thumbnails as $thumbnail){
        if($thumbnail['imgPrimary'] == 0) {
        $dv .= "<ul id='thumbnails-list'>";
        $dv .= "<div id='details-thumbnail-div'>";
        $dv .= "<li><img src='$thumbnail[imgPath]' alt='$thumbnail[imgName] class='thumbnail-image'></li>";
        $dv .= "</div>";
        $dv .= "</ul>";
        }
    }
    $dv .= "</div>";
    return $dv;
}


/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
   }

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }


// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
   }

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends resizeImage function


// Build the display based on search bar values
function buildSearchDisplay($searchOutcome) {

    $searchCount = 0;
    $id = "<div id='search-list-div'>";
    $id .= '<ul id="search-list-display">';
    foreach ($searchOutcome as $search) {
     $searchCount++;
     $id .= '<a href="/phpmotors/vehicles/index.php?action=vehicle-detail&invId='.urlencode($search['invId']).'">';
     $id .= '<div class="search-div">';
     $id .= '<li>';
     $id .= "<img src='$search[invThumbnail]' title='$search[invMake] $search[invModel] image on PHP Motors.com' alt='$search[invMake] $search[invModel] image on PHP Motors.com'>";
     $id .= "<h2 class='search-list-makeModel'>$search[invMake] $search[invModel]</h2>";
     $id .= "<span class='search-list-price'>Price: $$search[invPrice]</span>";
     $id .= '</li>';
     $id .= '</div>';
     $id .= '</a>';
   }
    $id .= '</ul>';

    // Number of search results
    $id .= "<div id='search-count-div'>";
    $id .= "<p id='search-count'>$searchCount results</p>";
    $id .= "</div>";

    // pagination
    if(!(isset($pagenum))) {
        $pagenum = 1;
    }
    // Number of rows on page
    $page_rows = 10;
    // Page number of last page
    $end = ceil($searchCount/$page_rows);
    // make sure page number isn't less than 1 or greater # of results
    if($pagenum < 1) {
        $pagenum = 1;
    } elseif ($pagenum > $end) {
        $pagenum = $end;
    }
    
    $id .= "<div id='pagenum'>";
    $id .= "<p>--Page $pagenum of $end--</p>";
    $id .= "</div>";

    $id .= "</div>";
    return $id;
   }

function cleanChars($str) {
    return preg_replace('/[^A-Za-z0-9\-]/', '', $str);
}

?>

