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
            <header>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>             
            </header>

            <nav>
                <?php // require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php';
                echo $navList; ?>
            </nav>      

            <div id="content-title">
                <h1>Welcome to PHP Motors!</h1>
            </div>

        <main>
        
        <div id="img-info">
            <h2>DMC Delorean</h2>

            <h3>
                3 Cup holders
                <br>Superman doors
                <br>Fuzzy dice!
            </h3>

            <button type="button" onclick="alert('Hello world!')" id="purchase-link">
            <strong>Own Today</strong>
            </button>
        </div>

        <div>
            <img src="/phpmotors/images/delorean.jpg" alt="DMC Delorean image" id="main-image"/>
        </div>

        <div id="container">
            <section id="upgrades-section">
                <div id="order-list-heading-1">
                    <h3>Delorean Upgrades</h3>
                </div>
                
                <div id="left-list">               
                    <figure class="top-items">
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux capacitor" class="order" id="flux"> 
                        <a href="#"><figcaption>Flux Capacitor</figcaption></a> 
                    </figure> 
                    
                    <figure class="top-items">
                        <img src="/phpmotors/images/upgrades/flame.jpg" alt="flames decals" class="order" id="flame">   
                        <a href="#"><figcaption>Flame Decals</figcaption></a>   
                    </figure>

                    <figure class="bottom-items">
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper stickers" class="order" id="bumper">  
                        <a href="#"><figcaption>Bumper Stickers</figcaption></a>
                    </figure>

                    <figure class="bottom-items"> 
                        <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub caps" class="order" id="hub">  
                        <a href="#"><figcaption>Hub Caps</figcaption></a>
                    </figure>
                    
                </div>
            </section>

            <section id="review-section">
                <div id="order-list-heading-2">
                    <h3>DMC Delorean Reviews</h3>
                </div>

                <div id="right-list">
                    <ul id="review-list">
                        <li>"So fast it's almost like traveling in time." (4/5)
                        </li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>
                </div>
            </section>

        </div>

        </main>
        <aside></aside>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
    </body>
</html>