<!-- 
This webpage was Designed, Coded, and belongs solely to TrevorDS (Sherrill)
Any other I.P. will credited below in the credits.
(All images, code snippets, etc. are found on google or royalty free
websites that do not require O.P. permissions.) 
If you believe that something is copyrighted OR you own the I.P., 
please contact Trevor at: trevordsherrill@gmail.com
Thank you.
[Credits]
- Background Image | BY: TeaHub (*Unknown Publisher) | LINK: https://www.teahub.io/photos/full/73-739794_matrix-wallpaper-blue.jpg
-

*Unknown Publisher (was found on google and I could not find a traceback to original)
-->
<?php session_start(); 

// CONFIG
$is_local = FALSE; // this will bypass log in for local usage.
$_SESSION['is_local'] = $is_local;

$pageList = array(
    "PHP Projects" => "php"
);

// Log In Redirect
if ($_SESSION['is_local'] !== TRUE) {
    if (!isset($_SESSION['loggedin'])) {
        header("Location: ./user/login.php");
        exit;
    }
}

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
        $file = "./pages/" . $location . ".php";
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

// Vars
$username = "???";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
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
               margin-top: 0;
           }
           #logout_bg {
               background-color: rgba(0, 0, 0, 0.9);
               border: 3px lightgray solid;
               border-radius: 3.5%;
               padding-top: 0.25em;
               padding-bottom: 0.25em;
               padding-left: 1em;
               padding-right: 1em;
               width: fit-content;
               margin: auto;
               margin-top: 2.5em;
               margin-bottom: 0;
               margin-right: 0.5em;
               text-align: right;
           }
           #picOfMe {
               width: 20em;
               height: 20em;
               margin: 2em;
           }
         </style>
    </head>
    <body>
        
        <div id='logout_bg'>
            <h3 style="margin-bottom: 0.5em; margin-top: 0;">Welcome back, <?= $username ?></h3>
            
            <form action="user/auth.php" method="POST" style="margin-bottom: 0em;">
                <input type="submit" name="logout" value="Log Out" />
            </form>
        </div>
        
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