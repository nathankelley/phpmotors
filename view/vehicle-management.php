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
                <h1>Vehicle Management</h1>
            </div>

        <main>
            <ul>
                <li><a href="/phpmotors/vehicles/index.php?action=add-classification">
                    Add Classification
                </a></li>
                <li><a href="/phpmotors/vehicles/index.php?action=add-vehicle">
                    Add Vehicle
                </a></li>
            </ul>

            <a href="/phpmotors/vehicles/index.php?action=getInventoryItems">Click</a>
    <?php
        if (isset($message)) {
            echo $message;
        }
        if (isset($classificationList)) {
            echo '<h2>Vehicles By Classification</h2>'; 
            echo '<p>Choose a classification to see those vehicles</p>'; 
            echo $classificationList;
        }
    ?>

    <p>
        <?php 
        echo $message;
        ?>
    </p>
    <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="inventoryDisplay"></table>
        </main>
        <aside></aside>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
        
    </div>
    <script src="/phpmotors/js/inventory.js"></script>
    </body>
</html><?php unset($_SESSION['message']); ?>