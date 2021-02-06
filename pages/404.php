<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>404 Page Not Found</title>
        <style>
           body {
               text-align: center;
               background-image: url('https://yoast.com/app/uploads/2016/10/404_error_checking_FI.jpg');
               background-repeat: no-repeat;
               background-attachment: fixed;
               background-size: cover;
               color: white;
           }
           #bg {
               background-color: rgba(0, 0, 0, 0.7);
               border: 3px black solid;
               border-radius: 3.5%;
               padding-top: 0.5em;
               padding-bottom: 1.5em;
               width: 30em;
               margin: auto;
               margin-top: 2.5em;
           }
         </style> 
    </head>
    <body>
        <div id='bg'>
            <h1>404 Page NOT Found</h1>
            <?php 
            if (isset($_SESSION['404_MSG'])) {
                echo "<p>The web page \"" . $_SESSION['404_MSG'] . "\" was not found.</p>";
            }
            ?>
            <form action="../index.php" method="POST">
                <input type="submit" name="transfer" value="Back to Home" />
            </form>
        </div>
    </body>
</html>
