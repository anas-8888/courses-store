<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show all bill</title>
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
        if ($_SESSION['usertype'] == 'C') {
            echo "<center><h2 style='color:white;'>You are not allowed to show this page</h2><center>";
        } else {
            $q = "select * from bill order by idu";
            $arr = $pdo->query($q);
            echo "<br /><table class='tableid' border=1><thead><th>User id</th><th>User name</th><th>Course name</th><th>Course price</th><th>Date</th><th>Delete</th></thead>";
            foreach ($arr as $row) {
                $idu = $row['idu'];
                $idc = $row['idc'];
                $q = "select fullname from useraccount where id=$idu";
                $ar = $pdo->query($q);
                $ar = $ar->fetch();
                $uname = $ar['fullname'];
                $q = "select * from course where id=$idc";
                $ar = $pdo->query($q);
                $ar = $ar->fetch();
                $cname = $ar['name'];
                $price = $ar['price'];
                $date = $row['date'];
                $bid=$row['id'];
                echo <<<ID_HTML
                        <tr>
                            <td>$idu</td>
                            <td>$uname</td>
                            <td>$cname</td>
                            <td>$price$</td>
                            <td>$date</td>
                            <td><a href='deletebill.php?bid=$bid' style='color: red;' onclick="return confirm('Are you sure you want delete?')">Delete</a></td>
                        </tr>
                    ID_HTML;
            }
            echo "</table>";
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