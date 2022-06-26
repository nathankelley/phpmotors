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
        

            <div id="content-title">
                <h1>Register</h1>
            </div>

        <main>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
            <form method="post" action="/phpmotors/accounts/index.php">
                <label for="clientFirstname">First Name<br>
                    <input type="text" id="fname" name="clientFirstname" size="25" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br>
                </label>
                <label for="clientLastname">Last Name<br>
                    <input type="text" id="lname" name="clientLastname" size="25" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br>
                </label>
                <label for="clientEmail">Email<br>
                    <input type="email" id="email" name="clientEmail" size="25" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
                </label>
                <label for="clientPassword">Password: 
                    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                    <input type="password" id="password" name="clientPassword" size="25" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                </label>
                <button type="button" id="showPassword">
                    Show Password
                </button><br><br>

                <button type="submit" name="submit" value="Register" id="registerClient">
                    Register
                </button>

                <input type="hidden" name="action" value="register">
            </form>
        </main>
        <aside></aside>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
        
    </div>
    </body>
</html>