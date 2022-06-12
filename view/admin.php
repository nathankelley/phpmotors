<?php
    if(!isset($_SESSION['loggedin'])) {
        header('Location: /phpmotors/?action=home');
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

        <main>
            <div id="admin-page-head">
                <h1 id="content-title">
                <?php 
                echo $_SESSION['clientData']['clientFirstname']." ".$_SESSION['clientData']['clientLastname']; 
                ?>
                </h1>

                <h3>You are logged in.</h3>
            </div>
            <ul>
                <li class="user-data">
                    <?php echo "First name: ".$_SESSION['clientData']['clientFirstname'] ?>
                </li>
                <li class="user-data">
                    <?php echo "Last name: ".$_SESSION['clientData']['clientLastname'] ?>
                </li>
                <li class="user-data">
                    <?php echo "Email: ".$_SESSION['clientData']['clientEmail'] ?>
                </li>
            </ul>

            <?php 
            if($_SESSION['clientData']['clientLevel'] > 1) {
                echo "<div id='admin-inv-man'>
                        <h1>Inventory Management</h1>
                        <h3>Use this link to manage the inventory.</h3>
                        <a href='/phpmotors/vehicles' title='Vehicle Management page, admin use only'>Vehicle Management</a>
                    </div>";
            }
            ?>
        </main>
        <aside></aside>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
        
    </div>
    </body>
</html>