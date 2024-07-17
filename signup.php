<?php
require_once 'connection.php';
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $email = $password = $cnofirmpassword = $signbirthday = "";
    if (isset($_POST['fullname'])) {
        $fullname = $_POST["fullname"];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (isset($_POST['cnofirmpassword'])) {
        $cnofirmpassword = $_POST['cnofirmpassword'];
    }
    if (isset($_POST['signbirthday'])) {
        $signbirthday = $_POST['signbirthday'];
    }
    if ($fullname == "" || $email == "" || $password == "" || $cnofirmpassword == "" || $signbirthday == "") {
        $error = "<center>Not all fields were entered!</center>";
    } elseif ($cnofirmpassword != $password) {
        $error = "<center>Cnofirm password is wrong!</center>";
    } else {
        $q = "SELECT * FROM useraccount WHERE email='$email'";
        if (($pdo->query($q))->rowCount() == 1) {
            $error = "<center>This Email is taken!</center>";
        } else {
            $q = "INSERT INTO useraccount(fullname,email,pass,bdate,usertype) VALUES(?, ?, ?, ?, ?)";
            $ps = $pdo->prepare($q);
            $usertype = "C";
            $ps->bindParam(1, $fullname, PDO::PARAM_STR);
            $ps->bindParam(2, $email, PDO::PARAM_STR);
            $ps->bindParam(3, $password, PDO::PARAM_STR);
            $ps->bindParam(4, $signbirthday, PDO::PARAM_STR);
            $ps->bindParam(5, $usertype, PDO::PARAM_STR);
            $ps->execute();
            $id = $pdo->lastInsertId();
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['usertype'] = $usertype;
            header("Location: home.php");
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
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

    <body>
        <div class="navbar">
            <a href="contactus.php">Contact Us</a>
        </div>
        <br />
        <h1>Welcome to Khalia Ala Allah Academy</h1>
        <div class="login-page">
            <div class="form">
                <form class="login-form" action="signup.php" method="post">
                    <h2>Sign up</h2>
                    <?php echo $error; ?>
                    <br />
                    <input type="text" name="fullname" placeholder="Full Name" required />
                    <input type="email" name="email" placeholder="Email" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <input type="password" name="cnofirmpassword" placeholder="Cnofirm password" required />
                    <input type="date" name="signbirthday" required />
                    <button type="submit" name="submit">Sign Up</button>
                    <br />
                    <br />
                    <a href="login.php">Log In</a>
                </form>
            </div>
        </div>
    </body>

</html>