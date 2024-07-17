<?php
require_once("connection.php");
session_start();
$error = "";
$cid = $_GET['cid'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $type = $_POST['type'];
    $teacher = $_POST['teacher'];
    $about = $_POST['about'];
    $price = $_POST['price'];
    $time = $_POST['time'];
    $newnumvid = $_POST['newnumvid'];
    if ($name != "") {
        $q = "UPDATE course set name='$name' WHERE id='$cid'";
        $ps = $pdo->query($q);
    }
    if ($type != "") {
        $q = "UPDATE course set type='$type' WHERE id='$cid'";
        $ps = $pdo->query($q);
    }
    if ($teacher != "") {
        $q = "UPDATE course set teacher='$teacher' WHERE id='$cid'";
        $ps = $pdo->query($q);
    }
    if ($about != "") {
        $q = "UPDATE course set about='$about' WHERE id='$cid'";
        $ps = $pdo->query($q);
    }
    if ($price != "") {
        $q = "UPDATE course set price='$price' WHERE id='$cid'";
        $ps = $pdo->query($q);
    }
    if ($time != "") {
        $q = "UPDATE course set time='$time' WHERE id='$cid'";
        $ps = $pdo->query($q);
    }
    header("Location: editvideos.php?cid=$cid&newnumvid=$newnumvid");
    $pdo = NULL;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit course</title>
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
            $q="select * from course where id='$cid'";
            $ps = $pdo->query($q);
            $ps=$ps->fetch();
            $name=$ps['name'];
            $price=$ps['price'];
            $time=$ps['time'];
            $teacher=$ps['teacher'];
            $about=$ps['about'];
            $type=$ps['type'];
            echo <<<ID_HTML
            <div class="login-page">
                <div class="form">
                    <form lass="login-form" action="edit.php?cid=$cid" method="POST">
                        <div style="padding: 20px 0; text-align: center; color: #ddd; font-size: x-large;">New course info:</div>
                        <input type="text" name="name" placeholder="Old name: $name" />
                        <input type="text" name="type" placeholder="Old type: $type" />
                        <input type="text" name="teacher" placeholder="Old teacher: $teacher" />
                        <input type="text" name="about" placeholder="Old description: $about" />
                        <input type="text" name="time" placeholder="Old time: $time" />
                        <input type="text" name="price" placeholder="Old price: $price$" />
                        <input type="text" name="newnumvid" placeholder="Number of new video" />
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