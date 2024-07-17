<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show my bill</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
</head>

<body>
    <?php
    require_once("connection.php");
    session_start();
    echo "<div class='navbar'>";
    if (isset($_SESSION["id"])) {
        echo <<<ID_HTML
                <a href="home.php">Home</a>
                </div>
                <br />
                <br />
                <br />
            ID_HTML;
        $idu = $_SESSION['id'];
        $name = $_SESSION['fullname'];
        $q = "select * from bill where idu=$idu";
        $arr = $pdo->query($q);
        echo "<center><h1>This Bill for user: $name</h1></center>";
        echo "<table class='tableid'><thead><th>Course id</th><th>Name of course</th><th>Date of pay</th><th>Price of course</th><th>Details of course</th></thead>";
        $sum = 0;
        foreach ($arr as $row) {
            $courseid = $row['idc'];
            $dateofpay = $row['date'];
            $q = "select name,price from course where id=$courseid";
            $ar = $pdo->query($q);
            $ar = $ar->fetch();
            $nameofcourse = $ar['name'];
            $priceofcourse = $ar['price'];
            $sum += $priceofcourse;
            echo <<<ID_HTML
                    <tr>
                        <td>$courseid</td>
                        <td>$nameofcourse</td>
                        <td>$dateofpay</td>
                        <td>$priceofcourse$</td>
                        <td><a href='roadmap.php?cid=$courseid' style='color: #58afe6;'>Details</a></td>
                    </tr>
            ID_HTML;
    }
    echo "</table>";
    echo "<center><h2 style='color:white;'>Your amount is: $sum$</h2><center><br />";
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