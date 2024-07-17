<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
    <title>Profile</title>
</head>

<body>
    <div class="navbar">
        <?php
        require_once("connection.php");
        session_start();
        if (isset($_SESSION['id'])) {
            echo <<<ID_HTML
                <a href="home.php">Home</a>
                </div>
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
            ID_HTML;
            $idu = $_SESSION['id'];
            $q = "select * from useraccount where id=$idu";
            $arr = $pdo->query($q);
            $arr = $arr->fetch();
            $id = $arr['id'];
            $name = $arr['fullname'];
            $email = $arr['email'];
            $bdate = $arr['bdate'];
            $type = ($arr['usertype'] == 'A' ? "Admin" : "Client");
            echo <<<ID_HTML
                    <center>
                        <table class='tableid'>
                            <thead>
                                <th>Id</th>
                                <th>Full name</th>
                                <th>Email</th>
                                <th>Berthdate</th>
                                <th>Type</th>
                            </thead>
                            <tr>
                                <td>$id</td>
                                <td>$name</td>
                                <td>$email</td>
                                <td>$bdate</td>
                                <td>$type</td>
                            </tr>
                        </table>
                    </center>
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
                <br />
                <br />
                <br /> 
            ID_HTML;
            echo "<center><h2 style='color:white;'>Pleas log in to see this page</h2><center>";
        }
        ?>
</body>

</html>