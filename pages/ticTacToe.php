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
$projectProblemLink = "https://edabit.com/challenge/b5aE6jRK6Tt7kF5Q8";
/*
 * - Problem Description: */
$projectProblemDesc = (
        "Create a function that takes a Tic-tac-toe board and returns \"X\" if "
        . "the X's are placed in a way that there are three X's in a row or "
        . "returns \"O\" if there is three O's in a row."
        );
/* 
 * - Problem Author: */
$projectAuthor = "Kyla";

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

function whoWon($board) {
    
    $whoWonReturn = "ERROR";
    
    $xWin = false;
    $oWin = false;
    
    
    // Horizontal Win
    foreach ($board as $row) {
        $xOnRow = 0;
        $oOnRow = 0;
        foreach ($row as $letter) {
            if ($letter === "X") {
                $xOnRow++;
            } 
            elseif ($letter === "O") {
                $oOnRow++;
            }
        }
        if ($xOnRow === 3) {
            $xWin = true;
        } 
        elseif ($oOnRow === 3) {
            $oWin = true;
        }
    }
    
    // Vertical Win
    for ($r = 0; $r < 3; $r++) {
        $xOnRow = 0;
        $oOnRow = 0;
        for ($i = 0; $i < 3; $i++) {
            if ($board[$i][$r] === "X") {
                $xOnRow++;
            }
            elseif ($board[$i][$r] === "O") {
                $oOnRow++;
            }
        }
        if ($xOnRow === 3) {
            $xWin = true;
        } 
        elseif ($oOnRow === 3) {
            $oWin = true;
        }
    }
    
    // Adjacent Win (Cross)
    // -- Left Cross
    $lc_rows = array(0,1,2);
    $lc_col = array(0,1,2);
    
    $lc_xOnRow = 0;
    $lc_oOnRow = 0;
    
    foreach ($lc_rows as $ind => $row) {
        if ($board[$ind][$lc_col[$ind]] === "X") {
            $lc_xOnRow++;
        } 
        elseif ($board[$ind][$lc_col[$ind]] === "O") {
            $lc_oOnRow++;
        }
        
        if ($lc_xOnRow === 3) {
            $xWin = true;
        } 
        elseif ($lc_oOnRow === 3) {
            $oWin = true;
        }
    }
    
    // -- Right Cross
    $rc_rows = array(0,1,2);
    $rc_col = array(2,1,0);
    
    $rc_xOnRow = 0;
    $rc_oOnRow = 0;
    
    foreach ($rc_rows as $ind => $row) {        
        if ($board[$ind][$rc_col[$ind]] === "X") {
            $rc_xOnRow++;
        } 
        elseif ($board[$ind][$rc_col[$ind]] === "O") {
            $rc_oOnRow++;
        }
        
        if ($rc_xOnRow === 3) {
            $xWin = true;
        } 
        elseif ($rc_oOnRow === 3) {
            $oWin = true;
        }
    }
    
    // Tie
    if (($xWin === false && $oWin === false) || ($xWin === true && $oWin === true)) {
        echo "Was a Tie! | ";
        $whoWonReturn = "Tie";
    } 
    // Normal Win X OR O
    else {
        if ($xWin === true) {
            echo "X Win! | ";
            $whoWonReturn = "X";
        } 
        elseif ($oWin === true) {
            echo "O Win! | ";
            $whoWonReturn = "O";
        }
    }
    return $whoWonReturn;
}


function isEqual ($item1, $item2) {
    if ($item1 === $item2) {
        return "Equal: true";
    } else {
        return "Equal: false";
    }
};

function tests() {
    echo isEqual("X", whoWon([
        ["X", "O", "X"],
        ["X", "O", "O"],
        ["X", "X", "O"],
    ])) . "<br>";
    echo isEqual("X", whoWon([
            ["O", "X", "O"],
            ["X", "X", "O"],
            ["O", "X", "X"],
        ])) . "<br>";
    echo isEqual("O", whoWon([
            ["X", "X", "O"],
            ["O", "X", "O"],
            ["X", "O", "O"],
        ])) . "<br>";
    echo isEqual("X", whoWon([
            ["X", "X", "X"],
            ["O", "X", "O"],
            ["X", "O", "O"],
        ])) . "<br>";
    echo isEqual("O", whoWon([
            ["X", "O", "X"],
            ["O", "O", "O"],
            ["X", "X", "O"],
        ])) . "<br>";
    echo isEqual("O", whoWon([
            ["O", "O", "X"],
            ["X", "O", "X"],
            ["O", "X", "O"],
        ])) . "<br>";
    echo isEqual("X", whoWon([
            ["O", "O", "X"],
            ["O", "X", "X"],
            ["X", "X", "O"],
        ])) . "<br>";
    echo isEqual("Tie", whoWon([
            ["O", "O", "X"],
            ["X", "X", "X"],
            ["O", "O", "O"],
        ])) . "<br>";
    echo isEqual("Tie", whoWon([
            ["O", "O", "X"],
            ["X", "X", "O"],
            ["O", "X", "O"],
        ])) . "<br>";
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