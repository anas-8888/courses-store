<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Road map</title>
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
        $cid = $_GET['cid'];
        $uid = $_SESSION["id"];
        if (isset($_GET['pn'])) {
            echo <<<ID_HTML
                    <center>
                        <div class="notibody">
                            Congratulations, you have paied this course
                        </div>
                    </center>
                ID_HTML;
        }
        $q = "select name from course where id='$cid'";
        $arr1 = $pdo->query($q);
        $arr1 = $arr1->fetch();
        $coursename = $arr1['name'];
        echo <<<ID_HTML
                <br />
                <center>
                    <div class="notibody">
                        welcome to $coursename course:
                    </div>
                </center>
                <br />
            ID_HTML;
        $q = "select * from bill where idc='$cid' AND idu='$uid'";
        $array = $pdo->query($q);
        $array = $array->fetchAll();
        if (!count($array) && $_SESSION['usertype'] == 'C') {
            echo <<<ID_HTML
                <br /><br /><br /><br /><br />
                <div class="notification">
                    <div class="notiglow"></div>
                    <div class="notiborderglow"></div>
                    <div class="notititle">
                        Welcome to Khalia Ala Allah Academy
                    </div>
                    <div class="notibody">
                        You must pay this course <a href='pay.php?cid=$cid'>Pay now</a>
                    </div>
                </div>
                ID_HTML;
        } else {
            $q = "select link from video where idc='$cid'";
            $arr = $pdo->query($q);
            $arr = $arr->fetchAll();
            if (count($arr)) {
                echo "<table class='tableid' border=1><tr><td>Week number</td><td>Video</td></tr>";
                $k = 1;
                $ii = 1;
                foreach ($arr as $row) {
                    $link = $row['link'];
                    $li1 = "";
                    for ($i = 0; $i < strlen($link); $i++) {
                        if ($link[$i] == '=') {
                            $li1 = substr($link, $i + 1);
                            break;
                        }
                    }
                    $str = ($k % 10 == 1) ? "st" : (($k % 10 == 2) ? "nd" : (($k % 10 == 3) ? "rd" : "th"));
                    $str = (($k == 11 || $k == 12 || $k == 13) ? "th" : $str);
                    echo <<<ID_HTML
                                <tr>
                                    <td><h1>$k$str week</h1></td>
                                    <td>
                                    <iframe width="800" height="400" src="https://www.youtube.com/embed/$li1" frameborder="0" allowfullscreen ></iframe>
                                   </td>
                                </tr>
                            ID_HTML;
                    $ii++;
                    if ($ii % 6 == 0) {
                        $k++;
                    }
                }
                echo "</table>";
            } else {
                echo <<<ID_HTML
                        <br />
                        <center>
                            <div class="notibody">
                                <h1>Attention: There is no videos yet.</h>
                            </div>
                        </center>
                    ID_HTML;
            }
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