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
                <h1>Add Car Classification</h1>
            </div>

            <form id="new-classification-form" method="post" action="/phpmotors/vehicles/index.php">
                <label for="classificationName"><strong>Classification Name</strong>
                    <span>Classifications are limited to 30 characters.</span><br>
                    <input type="text" id="classificationName" name="classificationName" class="vehicle-form-element" size="30" <?php if(isset($classificationName)){echo "value='$classificationName'";}  ?> required>
                </label>

                <button type="submit" name="submit" id="add-class-btn" class="vehicle-form-element">
                    Add Classification
                </button>

                <input type="hidden" name="action" value="add-classification">
            </form>

        <main>

        </main>
        <aside></aside>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
        
    </div>