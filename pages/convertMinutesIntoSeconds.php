<?php session_start();

// Log In Redirect
if ($_SESSION['is_local'] !== TRUE) {
    if (!isset($_SESSION['loggedin'])) {
        header("Location: ../user/login.php");
        exit;
    }
}

/* 
--------------------------------------------------------------------------------
----- PROJECT CONFIG -----------------------------------------------------------
--------------------------------------------------------------------------------
*/

/* Project Information:
 * - CodeAuthor: */ 
$codeAuthorName = "TrevorDS (me)";
/* 
 * - Date: */ 
$didProjectOn = "2/7/2021";
/* 
 * - Problem Link: */
$projectProblemLink = "https://edabit.com/challenge/FQyaaJx7orS7tiwz8";
/*
 * - Problem Description: */
$projectProblemDesc = (
        "Write a function that takes an integer minutes and converts it to seconds."
        );
/* 
 * - Problem Author: */
$projectAuthor = "S-G-Coder";

/* 
--------------------------------------------------------------------------------
----- REDIRECT ENFORCEMENT -----------------------------------------------------
--------------------------------------------------------------------------------
*/

$file = basename(__FILE__);
$file_noExnt = basename(__FILE__, ".php");

if ($_SESSION['fileKey'] == null) {
    if (!$_POST) {
        header("Location: index.php");
        exit;
    }
}

if ($_SESSION['fileKey'] != null) {
    $_SESSION['fileKey'] = null;
}

echo "<div id=\"topMarginDiv\">";
echo "<h1 style='margin-bottom: 0.25em;'>Project: $file_noExnt</h1>";
echo "<h3 style='margin-top: 0;'><i>By: $projectAuthor</i></h3>";
echo "<h3 style='margin-top: 2em; margin-bottom: 0.25em;'>Description</h3>";
echo "<p style='width: 30em; margin: auto;'>\"$projectProblemDesc\"</p>";
echo "<h3 style='margin-bottom: 0.25em;'>Code</h3>";
echo "<p style='margin-bottom: 1.5em;'><i>Coded by $codeAuthorName on $didProjectOn</i></p>";
echo "<hr>";
echo "</div>";

/* 
--------------------------------------------------------------------------------
----- PROJECT CODE -------------------------------------------------------------
--------------------------------------------------------------------------------
*/

function returnFromPython($var, $should_echo) {
    
    $output;
    $returnCode;
    
    $pyReturn = exec('python ../pycode/convertMinutesIntoSeconds.py ' . $var, $output, $returnCode);
    if ($should_echo === true) {
        printf('%d<br>', $returnCode);
    }
    
    return $returnCode;
}


function isEqual ($item1, $item2) {
    if ($item1 === $item2) {
        return "Equal: true";
    } else {
        return "Equal: false";
    }
};

function tests() {
    echo isEqual(360, returnFromPython(6, true)) . "<br>";
    echo isEqual(240, returnFromPython(4, true)) . "<br>";
    echo isEqual(480, returnFromPython(8, true)) . "<br>";
    echo isEqual(3600, returnFromPython(60, true)) . "<br>";
}

tests();

$tested_py_isVisible = false;

if ($_POST) {
    if ($_POST['pythonInputSubmit']) {
        
        $test_var = $_POST['pythonInput'];
        echo "<p style=\"margin-top: 3em;\"><i>Your tested input's output: " . returnFromPython($test_var, false) . "</i></p>";
        
        $tested_py_isVisible = true;
        
    }
}

?>

<form action="<?= $file ?>" method="POST" <?php if($tested_py_isVisible === false) { echo 'style="margin-top: 3em;"'; } ?>>
    <input type="number" name="pythonInput" value="" placeholder="Enter an integer to test" min="0" />
    <input type="submit" name="pythonInputSubmit" value="Test Input" />
</form>

<?php

// -----------------------------------------------------------------------------

if (isset($_POST['downloadFile'])) {
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}

// -----------------------------------------------------------------------------

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Project File: <?= $file ?></title>
        <style>
            #topMarginDiv {
                margin-top: 3.5em;
                margin-bottom: 1.5em;
            }
            body {
                text-align: center;
                background-color: lightgray;
                color: black;
            }
            #topForm {
                margin-top: 1.5em;
            }
            .likeabutton { 
                background-color: #00CCFF;
                padding: 8px 16px;
                display: inline-block;
                text-decoration: none;
                color: #FFFFFF;
                border-radius: 3px;
            }
            .likeabutton:active { 
                background-color: #0066FF;
            }
         </style>
    </head>
    <body>
        <br><hr style="margin-bottom: 0;">
        <form action="<?= $file ?>" method="POST" id="topForm">
            <input type="submit" name="downloadFile" value="Download File" />
        </form>
        <form target="_blank" action="<?= $file ?>" method="POST">
            <input onclick="window.location.href = '<?= $projectProblemLink ?>';" name="newTab" type="submit" value="Visit Problem Site" />
        </form>
        <form action="../index.php" method="POST">
            <input type="submit" name="transfer" value="Back to Home" />
        </form>
    </body>
</html>
