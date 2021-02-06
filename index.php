<!-- 
This webpage was Designed, Coded, and belongs solely to TrevorDS (Sherrill)
Any other I.P. will credited below in the credits.
(All images, code snippets, etc. are found on google or royalty free
websites that do not require O.P. permissions.) 
If you believe that something is copyrighted OR you own the I.P., 
please contact Trevor at: trevordsherrill@gmail.com
Thank you.
[Credits]
- Background Image | BY: TeaHub (Unknown Publisher) | LINK: https://www.teahub.io/photos/full/73-739794_matrix-wallpaper-blue.jpg
-
-->
<?php session_start(); 

// CONFIG
$pageList = array(
    "PHP Projects" => "php"
);

$_SESSION['404_MSG'] = null;

if ($_POST) {
    if (isset($_POST['redirectPage'])) {
    
        $location = "???";
        $displayName;

        foreach ($_POST as $value) {
            if ($value !== "redirectPage") {
                if ($pageList[$value]) {
                    $location = $pageList[$value];
                    $displayName = $value;
                    break;
                }
            }
        }
        
        // Page Exists
        $file = "./" . $location . ".php";
        $fileExists = file_exists($file);
        
        if($fileExists === true) {
            
            $_SESSION['fileKey'] = "true";
            
            header("Location: " . $file);
            exit;
            
        }
        elseif ($fileExists === false) {
            
            $_SESSION['404_MSG'] = $displayName;
            
            header("Location: 404.php");
            exit;
            
        }
    
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TrevorDS's Edabit Profile</title>
        <link rel='stylesheet' href='css/style.css' />
        <style>
           body {
               text-align: center;
               background-image: url('https://www.teahub.io/photos/full/73-739794_matrix-wallpaper-blue.jpg');
               background-repeat: repeat;
               color: white;
           }
           #bg {
               background-color: rgba(0, 0, 0, 0.9);
               border: 3px lightgray solid;
               border-radius: 3.5%;
               padding-top: 0.5em;
               padding-bottom: 1.5em;
               width: 30em;
               margin: auto;
               margin-top: 2.5em;
           }
           #picOfMe {
               width: 20em;
               height: 20em;
               margin: 2em;
           }
         </style>
    </head>
    <body>
        <div id='bg'>
            <h1>TrevorDS's Edabit Portfolio</h1>
            
            <img id="picOfMe" src="images/me.jpg" alt="A Picture of Trevor, the website author." />

            <form action="index.php" method="POST">
                <input type="hidden" name="redirectPage" value="redirectPage" />
                <?php
                foreach ($pageList as $key => $val) {
                    echo "<h3>$key</h3><input type=\"submit\" name=\"$val\" value=\"$key\" /><br><br>";
                }
                ?>
            </form>
        </div>
    </body>
</html>