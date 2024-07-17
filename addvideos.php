<?php
require_once("connection.php");
session_start();
$error = "";
$numberofvideos = $_GET['number'];
$idc = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $videos = [];
    $f = 1;
    for ($i = 1; $i <= $numberofvideos; $i++) {
        if ($_POST[$i]!="") {
            $videos[] = $_POST[$i];
        } else {
            $f = 0;
            $error = "<center>Not all fields were entered!</center>";
            break;
        }
    }
    if ($f) {
        for ($i = 1; $i <= $numberofvideos; $i++) {
            $q = "INSERT INTO video(idc,link) VALUES(?, ?)";
            $ps = $pdo->prepare($q);
            $ps->bindParam(1, $idc, PDO::PARAM_INT);
            $ps->bindParam(2, $videos[$i - 1], PDO::PARAM_STR);
            $ps->execute();
        }
        header("Location: home.php");
        $pdo = NULL;
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add videos</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <?php
    echo "<div class='navbar'>";
    if (isset($_SESSION["id"])) {
        echo <<<ID_HTML
                <a href="home.php">Home</a>
                </div>
                <br />
                <br />
                <br />
            ID_HTML;
        if ($_SESSION['usertype'] == 'C') {
            echo "<center><h2 style='color:white;'>You are not allowed to show this page</h2><center>";
        } else {
            echo <<<ID_HTML
                            <div class="login-page">
                            <div class="form">
                            <form lass='login-form' action='addvideos.php?id=$idc&number=$numberofvideos' method='POST'>
                            <div style="padding: 20px 0; text-align: center; color: #ddd; font-size: x-large;">videos link:</div>
                    ID_HTML;
            for ($i = 1; $i <= $numberofvideos; $i++) {
                $str = ($i % 10 == 1) ? "st" : (($i % 10 == 2) ? "nd" : (($i % 10 == 3) ? "rd" : "th"));
                $str = (($i == 11 || $i == 12 || $i == 13) ? "th" : $str);
                echo "<input type='text' name=$i placeholder='Enter the link of $i$str video ' />";
            }
            echo <<<ID_HTML
                            $error
                            <br />
                        <button type="submit">Continue</button>
                        </form>
                        <br /><center><a href='home.php'>Go back to home</a></center>
                        </div>
                        </div>
                    ID_HTML;
        }
    } else {
        echo <<<ID_HTML
                <a href="login.php">Log In</a>
                <a href="signup.php">Sign Up</a>
                </div>
                <br />
                <br />
                <br />
            ID_HTML;
        echo "<center><h2 style='color:white;'>Pleas log in to see this page</h2><center>";
    }
    ?>
</body>

</html>