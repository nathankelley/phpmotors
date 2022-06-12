<div id="header-div">
    <a href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png"  alt="PHP Motor logo" id="logo-img"></a>

    <div id="welcome-logout-link">
        <?php   
        if(isset($_SESSION['loggedin'])){
            // do something here if the value is TRUE
            echo "<span>
            <a href='/phpmotors/accounts/index.php?action=admin' title='View your info' id='client-page'>".$_SESSION['clientData']['clientFirstname']."</a> | ";
            echo "<a href='/phpmotors/accounts/index.php?action=Logout' title='Logout of PHP Motors' id='client-logout'>Logout</a></span>";
        }
        ?>
    </div>

    <?php 
        if(!isset($_SESSION['loggedin'])){
            echo "<a href='/phpmotors/accounts/index.php?action=login'  title='Login or register with PHP Motors' id='account-link'>
            My Account</a>";
        }
    ?>
</div>