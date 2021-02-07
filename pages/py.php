<?php session_start();

// Log In Redirect
if ($_SESSION['is_local'] !== TRUE) {
    if (!isset($_SESSION['loggedin'])) {
        header("Location: ../user/login.php");
        exit;
    }
}

// CONFIG
$pageList = array(
    "Convert Minutes Into Seconds" => "convertMinutesIntoSeconds"
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
        <link rel='stylesheet' href='../css/style.css' />
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
           #logout_bg {
               background-color: rgba(0, 0, 0, 0.9);
               border: 3px lightgray solid;
               border-radius: 3.5%;
               padding-top: 0.25em;
               padding-bottom: 0.25em;
               padding-left: 1em;
               padding-right: 1em;
               width: 20em;
               margin: auto;
               margin-top: 2.5em;
               margin-bottom: 0;
               margin-right: 0.5em;
               text-align: right;
           }
           #buttonDivBg {
               background-color: rgba(0, 0, 0, 0.9);
               border: 3px lightgray solid;
               border-radius: 3.5%;
               padding-top: 1em;
               padding-bottom: 1em;
               width: 10em;
               margin: auto;
               margin-top: 1em;
           }
           #pFont {
               
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
            <h1><?php echo strtoupper(basename(__FILE__, ".php")); ?> Projects</h1>

            <form action="<?php echo basename(__FILE__); ?>" method="POST">
                <input type="hidden" name="redirectPage" value="redirectPage" />
                <?php
                foreach ($pageList as $key => $val) {
                    echo "<p id='pFont'>\"$key\" Project</p><input type=\"submit\" name=\"$val\" value=\"$key\" /><br><br>";
                }
                ?>
            </form>
        </div>
        
        <div id='buttonDivBg'>
            <form action="../index.php" method="POST">
                <input type="submit" name="transfer" value="Back to Home" />
            </form>
        </div>
        
    </body>
</html>
