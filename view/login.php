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
                <h1>Sign in</h1>
            </div>

        <main>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
            <form action="/phpmotors/accounts/index.php" method="post" id="loginForm">
                <label for="clientEmail">Email<br>
                    <input name="clientEmail" id="clientEmail" type="text" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
                </label>
                <label for="clientPassword">Password<br>
                    <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                </label><br><br>
                <button type="submit" name="submit" id="signIn">
                    Sign-in
                </button>

                <input type="hidden" name="action" value="Login">
            </form>

            <div id="newAccountDiv">
                <a href="/phpmotors/accounts/index.php?action=registration" id="clientSignUp">Not a member yet?</a>
            </div>

        </main>
        <aside></aside>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
        
    </div>
    </body>
</html>