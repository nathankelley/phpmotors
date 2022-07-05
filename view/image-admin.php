<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap">
        <title>PHP Motors - Image Management</title>
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
                <h1>Image Management Here</h1>
            </div>

        <main id='image-admin-main'>
            <?php
                if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                }
            ?>

            <h3>Choose one of the options below:</h3>

            <h2>Add New Vehicle Image</h2>

        <div id='upload-image-form'>
            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
            <label for="invItem">Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset>
                    <label>Is this the main image for the vehicle?</label>
                    <label for="priYes" class="pImage">Yes</label>
                        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
            <label>Upload Image:</label>
                <input type="file" name="file1">
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>
        </div>  
                  
            <hr>

        <div id='delete-image-form'>
            <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
                if (isset($imageDisplay)) {
                echo $imageDisplay;
            } ?>
        </div>
        </main>
        <aside></aside>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
        
    </div>
    </body>
</html><?php unset($_SESSION['message']); ?>