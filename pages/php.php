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
    "Steps To Convert" => "stepsToConvert",
    "Tic-Tac-Toe" => "ticTacToe"
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
