<!DOCTYPE html>
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
            <div id="message">
                <?php if(isset($message)){
                echo $message; }
                ?>
            </div>

            <div id="thumbnails">
                <?php if(isset($thumbnailDisplay)){
                    echo $thumbnailDisplay;
                } ?>
            </div>

            <div id="vehicle-details">
                <?php if(isset($vehicleDisplay)){
                echo $vehicleDisplay;
                } ?>
            </div>

            <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
            </footer>
        </main>
        <aside></aside>
    </div>
    </body>
</html>