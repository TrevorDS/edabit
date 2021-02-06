<?php session_start();

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
$didProjectOn = "2/5/2021";
/* 
 * - Problem Link: */
$projectProblemLink = "https://edabit.com/challenge/yBCXZ97zYeEirPWSL";
/*
 * - Problem Description: */
$projectProblemDesc = (
        "Return the smallest number of steps it takes to convert a string entirely "
        . "into uppercase or entirely into lower case, whichever takes the fewest "
        . "number of steps. A step consists of changing one character from lower "
        . "to upper case, or vice versa."
        );
/* 
 * - Problem Author: */
$projectAuthor = "Helen Yu";

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

function stepsToConvert($str) {
    
    $strLength = strlen($str);
    
    $steps = 0;
    $upper = 0;
    $lower = 0;
    
    if ($strLength > 0 && ctype_alpha($str) == true && $str == trim($str)) {
        
        for ($i = 0; $i < $strLength; $i++) {
            // Check UpperCase
            if (ctype_upper($str[$i]) == true) {
                $upper++;
            } 
            // Check Lower
            elseif (ctype_lower($str[$i]) == true) {
                $lower++;
            }
        }

        // Check better
        $steps = $upper;

        if ($lower < $upper) {
            $steps = $lower;
        }
        
        // Check for ALREADY upper / lower
        if ($steps === $strLength) {
            $steps = 0;
        }
        
    }
    
    if ($str === "") {
        $str = "<i>blank string</i>";
    }
    
    echo $str . ": $steps | ";
    
    return $steps;
}


function isEqual ($item1, $item2) {
    if ($item1 === $item2) {
        return "Equal: true";
    } else {
        return "Equal: false";
    }
};

function tests() {
    echo isEqual(1, stepsToConvert('abC')) . "<br>";
    echo isEqual(2, stepsToConvert('abCBA')) . "<br>";
    echo isEqual(0, stepsToConvert('aba')) . "<br>";
    echo isEqual(0, stepsToConvert('ABA')) . "<br>";
    echo isEqual(3, stepsToConvert('abaCCC')) . "<br>";
    echo isEqual(4, stepsToConvert('abaaCCCDE')) . "<br>";
    echo isEqual(5, stepsToConvert('CCaaCCaaCa')) . "<br>";
    echo isEqual(0, stepsToConvert('')) . "<br>";
}

tests();

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
        <link rel='stylesheet' href='css/style.css' />
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