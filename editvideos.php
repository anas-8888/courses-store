<?php
require_once("connection.php");
session_start();
$idc = $_GET['cid'];
$newnumvid = $_GET['newnumvid'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['uv'])) {
        $uv = $_POST['uv'];
        foreach ($uv as $k => $v) {
            if ($v != "") {
                $q = "UPDATE video set link='$v' where id='$k'";
                $pdo->query($q);
            }
        }
    }
    if (isset($_POST['iv'])) {
        $iv = $_POST['iv'];
        foreach ($iv as $row) {
            if ($row != "") {
                $q = "insert into video(link,idc) value('$row',$idc)";
                $pdo->query($q);
            }
        }
    }
    if (isset($_POST['cb'])) {
        $cp = $_POST['cb'];
        foreach ($cp as $row) {
            $q = "DELETE FROM video WHERE id='$row'";
            $pdo->query($q);
        }
    }
    header("Location: home.php");
    $pdo = NULL;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit videos</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
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
            $qq = "select * from video where idc='$idc'";
            $arrr = $pdo->query($qq);
            echo <<<ID_HTML
                            <div class="login-page">
                            <div class="form">
                            <form lass='login-form' action='editvideos.php?cid=$idc&newnumvid=$newnumvid' method='POST'>
                            <a href='edit.php?cid=$idc'>Back</a>
                            <div style="padding: 20px 0; text-align: center; color: #ddd; font-size: x-large;">videos link:</div>
                    ID_HTML;
            $linkid = 0;
            $arrr=$arrr->fetchAll();
            if(!count($arrr)&&$newnumvid==""){
                echo "<center><h2>There is no video links here, go back and add</h2></center><br />";
            }
            foreach ($arrr as $row) {
                $linkid = $row['id'];
                $link = $row['link'];
                echo "<table><tr><td>";
                echo "<input size='25' type='text' name='uv[$linkid]' placeholder='$link' />";
                echo "</td><td>Delete<input type='checkbox' name='cb[]' value='$linkid' /></td></table>";
            }

            for ($i = 0; $i < $newnumvid; $i++) {
                echo "<input size='20' type='text' name='iv[]' placeholder='New link' />";
            }
            echo <<<ID_HTML
                        <br />
                        <button type="submit">Continue</button>
                        </form>
                        </div>
                        </div>
                    ID_HTML;
        }
    } else {
        echo <<<ID_HTML
                <a href="login.php">Log In</a>
                <a href="signup.php">Sign Up</a>
            ID_HTML;
        echo "<center><h2 style='color:white;'>Pleas log in to see this page</h2><center>";
    }

    ?>
</body>

</html>