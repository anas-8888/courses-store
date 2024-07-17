<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
    <title>my courses</title>
</head>

<body>
    <div class="navbar">
        <?php
        require_once("connection.php");
        session_start();
        if ((isset($_SESSION['id']) && $_SESSION['usertype'] == 'C' )||$_SESSION['usertype'] == 'A') {
            echo <<<ID_HTML
                <a href="home.php">Home</a>
                </div>
                <br />
                <br />
            ID_HTML;
            echo "<center><h2 style='color:white;'>This is your Courses:</h2><center>";
            $idu = $_SESSION['id'];
            $q = "select * from bill where idu=$idu";
            $arr = $pdo->query($q);
            echo <<<ID_HTML
                <center>
                    <table class='tableid'>
                        <thead>
                            <th>Course id</th>
                            <th>Course name</th>
                            <th>Date of pay</th>
                            <th>Course price</th>
                        </thead>
            ID_HTML;
            $sum = 0;
            foreach ($arr as $row) {
                $idc = $row['idc'];
                $date = $row['date'];
                $qq = "select * from course where id='$idc'";
                $ar = $pdo->query($qq);
                $ar = $ar->fetch();
                $name = $ar['name'];
                $price = $ar['price'];
                $sum += $price;
                echo <<<ID_HTML
                        <tr>
                            <td>$idc</td>
                            <td>$name</td>
                            <td>$date</td>
                            <td>$price$</td>
                        </tr>
                ID_HTML;
            }
            echo <<<ID_HTML
                    </table>
                </center>
                <center><h2 style='color:white;'>Your amount is: $sum$</h2></center>
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
            ID_HTML;
        } else {
            echo <<<ID_HTML
                <a href="login.php">Log in</a>
                <a href="signup.php">Sign up</a>
                </div>
                <br />
                <br />
                <br />
                <br />
                <center>
                    <h2 style='color:white;'>
                        You are not allowed to show this page
                    </h2>
                <center>
            ID_HTML;
            exit(0);
        }
        ?>
</body>

</html>