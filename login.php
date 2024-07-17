<?php
require_once 'connection.php';
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $password = "";
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if ($email == "" || $password == "") {
        $error = "<center>Not all fields were entered!</center>";
    } else {
        $q = "SELECT * FROM useraccount WHERE email='$email' AND pass='$password'";
        $arr = $pdo->query($q);
        if ($arr->rowCount() == 1) {
            $arr = $arr->fetch();
            session_start();
            $_SESSION['id'] = $arr['id'];
            $_SESSION['fullname'] = $arr['fullname'];
            $_SESSION['usertype'] = $arr['usertype'];
            header("Location: home.php");
            $pdo = NULL;
            exit();
        } else {
            $error = "<center>Wrong log in!</center>";
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
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
</head>

<body>
    <div class="navbar">
        <a href="contactus.php">Contact Us</a>
    </div>
    <br />
    <h1>Welcome to Khalia Ala Allah Academy</h1>
    <div class="login-page">
        <div class="form">
            <form class="login-form" action="login.php" method="POST">
                <h2>Log in</h2>
                <?php echo $error; ?>
                <input type="email" placeholder="email" required name="email" />
                <input type="password" placeholder="password" required name="password" />
                <button type="submit">Log In</button>
                <br />
                <br />
                <a href="signup.php">Sign Up</a>
            </form>
        </div>
    </div>
</body>

</html>