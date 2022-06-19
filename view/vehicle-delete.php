<?php 
    // CHECK THAT USER IN CURRENT SESSION HAS AUTHORIZATION
    // IF NOT, RETURN TO HOME VIEW
    if($_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap">
        <title><?php if(isset($invInfo['invMake'])){ 
	    echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
                <h1><?php if(isset($invInfo['invMake'])){ 
	            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
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
                    <input type="text" id="invMake" name="invMake" class="vehicle-form-element" required readonly

                    <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> >
                </label>

                <label for="invModel"><strong>Model</strong>
                    <input type="text" id="invModel" name="invModel" class="vehicle-form-element" required

                    <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> >
                </label>

                <label for="invDescription"><strong>Description</strong>
                    <textarea id="invDescription" name="invDescription" class="vehicle-form-element" required><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                </label>

                <p>Confirm Vehicle Deletion. The delete is permanent.</p>

                <button type="submit" id="add-vehicle-btn" name="submit" value="Delete Vehicle" class="vehicle-form-element">
                    Delete Vehicle
                </button>

                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
                echo $invInfo['invId'];} ?>">
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