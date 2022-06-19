<?php 
    // CHECK THAT USER IN CURRENT SESSION HAS AUTHORIZATION
    // IF NOT, RETURN TO HOME VIEW
    if($_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/');
        exit;
    }

// Build the classifications option list
$classifList = '<select name="classificationId" id="classificationId">';
$classifList .= "<option>Choose a Car Classification</option>";
foreach ($carClassifications as $classification) {
 $classifList .= "<option value='$classification[classificationId]'";
 if(isset($classificationId)){
  if($classification['classificationId'] === $classificationId){
   $classifList .= ' selected ';
  }
 } elseif(isset($invInfo['classificationId'])){
 if($classification['classificationId'] === $invInfo['classificationId']){
  $classifList .= ' selected ';
 }
}
$classifList .= ">$classification[classificationName]</option>";
}
$classifList .= '</select>';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap">
        <title><?php 
        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) { 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } 
	    elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; 
        }
    ?> | PHP Motors</title>
        <link href="/phpmotors/css/stylesheet.css" rel="stylesheet" type="text/css" media="screen"/>

    </head>
    <body>
    <div id="wrapper">
        <div id="logo-account">
            <header>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>             
            </header>
        </div>
            <div id="navigation">
                <nav>
                    <?php //require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php';
                    echo $navList; ?>  
                </nav>
            </div>

            <div id="content-title">
                <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) { 
	            echo "Modify$invMake $invModel"; }?></h1>
            </div>

            <p><strong>*Note all Fields are Required</strong></p>

            <?php
               if (isset($message)) {
                echo $message;
            }
            ?>

            <form id="add-vehicle-form" method="post" action="/phpmotors/vehicles/index.php">
                <div id="classification-list" class="vehicle-form-element">
                    <?php
                        echo $classificationList;
                    ?>
                </div>
                <label for="invMake"><strong>Make</strong>
                    <input type="text" id="invMake" name="invMake" class="vehicle-form-element" required

                    <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> >
                </label>

                <label for="invModel"><strong>Model</strong>
                    <input type="text" id="invModel" name="invModel" class="vehicle-form-element" required

                    <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> >
                </label>

                <label for="invDescription"><strong>Description</strong>
                    <textarea id="invDescription" name="invDescription" class="vehicle-form-element" required>

                    <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?>
                    </textarea>
                </label>

                <label for="invImage"><strong>Image Path</strong>
                    <input type="text" id="invImage" name="invImage" class="vehicle-form-element" required

                    <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?> >
                </label>

                <label for="invThumbnail"><strong>Thumbnail Path</strong>
                    <input type="text" id="invThumbnail" name="invThumbnail" class="vehicle-form-element" required

                    <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?> >
                </label>

                <label for="invPrice"><strong>Price</strong>
                    <input type="text" id="invPrice" name="invPrice" class="vehicle-form-element" required

                    <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?> >
                </label>

                <label for="invStock"><strong># In Stock</strong>
                    <input type="text" id="invStock" name="invStock" class="vehicle-form-element" required

                    <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?> >
                </label>

                <label for="invColor"><strong>Color</strong>
                    <input type="text" id="invColor" name="invColor" class="vehicle-form-element" required

                    <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?> >
                </label>

                <button type="submit" id="add-vehicle-btn" name="submit" value="Update Vehicle" class="vehicle-form-element">
                    Modify Vehicle
                </button>

                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="
                <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                elseif(isset($invId)){ echo $invId; } ?>
                ">
            </form>
        <main>

        </main>
        <aside></aside>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
        
    </div>
    </body>
</html>