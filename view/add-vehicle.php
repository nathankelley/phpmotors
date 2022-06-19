<?php 
    // CHECK THAT USER IN CURRENT SESSION HAS AUTHORIZATION
    // IF NOT, RETURN TO HOME VIEW
    if($_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/');
        exit;
    }

// Build the select list
$classificationList = '<select name="classificationId" id="classification">';
$classificationList .= '<option value="choose">Choose Car Classification</option>';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap">
        <title>PHP Motors</title>
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
                <h1>Add Vehicle</h1>
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
                    <input type="text" id="invMake" name="invMake" class="vehicle-form-element" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> required>
                </label>

                <label for="invModel"><strong>Model</strong>
                    <input type="text" id="invModel" name="invModel" class="vehicle-form-element" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> required>
                </label>

                <label for="invDescription"><strong>Description</strong>
                    <textarea id="invDescription" name="invDescription" class="vehicle-form-element" <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> required>
                    </textarea>
                </label>

                <label for="invImage"><strong>Image Path</strong>
                    <input type="text" id="invImage" name="invImage" class="vehicle-form-element" <?php if(isset($invImage)){echo "value='$invImage'";}  ?> required>
                </label>

                <label for="invThumbnail"><strong>Thumbnail Path</strong>
                    <input type="text" id="invThumbnail" name="invThumbnail" class="vehicle-form-element" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> required>
                </label>

                <label for="invPrice"><strong>Price</strong>
                    <input type="text" id="invPrice" name="invPrice" class="vehicle-form-element" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required>
                </label>

                <label for="invStock"><strong># In Stock</strong>
                    <input type="text" id="invStock" name="invStock" class="vehicle-form-element" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required>
                </label>

                <label for="invColor"><strong>Color</strong>
                    <input type="text" id="invColor" name="invColor" class="vehicle-form-element" <?php if(isset($invColor)){echo "value='$invColor'";}  ?> required>
                </label>

                <button type="submit" id="add-vehicle-btn" name="submit" value="Register" class="vehicle-form-element">
                    Add Vehicle
                </button>

                <input type="hidden" name="action" value="add-vehicle">
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