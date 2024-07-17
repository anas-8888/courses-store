<?php
require_once("connection.php");
session_start();
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $type = $teacher = $numberofvideos = $price = $time = $about = "";
    if (isset($_POST['name'])) {
        $name = $_POST["name"];
    }
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    }
    if (isset($_POST['about'])) {
        $about = $_POST['about'];
    }
    if (isset($_POST['teacher'])) {
        $teacher = $_POST['teacher'];
    }
    if (isset($_POST['numberofvideos'])) {
        $numberofvideos = $_POST['numberofvideos'];
    }
    if (isset($_POST['price'])) {
        $price = $_POST['price'];
    }
    if (isset($_POST['time'])) {
        $time = $_POST['time'];
    }
    if ($name == "" || $type == "" || $teacher == "" || $about == "" || $numberofvideos == "" || $price == "" || $time == "") {
        $error = "<center>Not all fields were entered!</center>";
    } elseif ($numberofvideos < 1) {
        $error = "<center>Number of videos is wrong!</center>";
    } elseif ($time < 1) {
        $error = "<center>Time of videos is wrong!</center>";
    } elseif ($price < 1) {
        $error = "<center>Price of videos is wrong!</center>";
    } else {
        $q = "SELECT * FROM course WHERE name='$name' AND teacher='$teacher' ";
        if (($pdo->query($q))->rowCount() == 1) {
            $error = "<center>This course is alrady exist!</center>";
        } else {
            $q = "INSERT INTO course(name,type,teacher,price,time,about) VALUES(?, ?, ?, ?, ?, ?)";
            $ps = $pdo->prepare($q);
            $ps->bindParam(1, $name, PDO::PARAM_STR);
            $ps->bindParam(2, $type, PDO::PARAM_STR);
            $ps->bindParam(3, $teacher, PDO::PARAM_STR);
            $ps->bindParam(4, $price, PDO::PARAM_INT);
            $ps->bindParam(5, $time, PDO::PARAM_INT);
            $ps->bindParam(6, $about, PDO::PARAM_STR);
            $ps->execute();
            $id = $pdo->lastInsertId();
            header("Location: addvideos.php?id=$id&number=$numberofvideos");
            $pdo = NULL;
            exit();
        }
    }
    $pdo = NULL;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add course</title>
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
            echo <<<ID_HTML
                    <div class="login-page">
                        <div class="form">
                            <form lass="login-form" action="add.php" method="POST">
                                <div style="padding: 20px 0; text-align: center; color: #ddd; font-size: x-large;">course info:</div>
                                <input type="text" name="name" placeholder="Enter the name of course" required />
                                <input type="text" name="type" placeholder="Enter the type of course" required />
                                <input type="text" name="teacher" placeholder="Enter the name of course teacher" required />
                                <input type="text" name="about" placeholder="Talk about course" required />
                                <input type="text" name="time" placeholder="Enter the time of course" required />
                                <input type="text" name="numberofvideos" placeholder="Enter the number of videos" required />
                                <input type="text" name="price" placeholder="Enter the price of course in $" required />
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