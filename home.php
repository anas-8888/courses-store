<?php
require_once("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
    <title>khalia ala allah co.</title>
    <script>
        var el_up = document.getElementById("GFG_UP");

        el_up.innerHTML =
            "Click on the LINK for further confirmation.";
    </script>
</head>

<body>
    <div class="navbar">
        <?php
        if (isset($_SESSION["id"])) {
            echo <<<ID_HTML
                    <a href="logout.php">Log out</a>
                ID_HTML;
        } else {
            echo <<<ID_HTML
                    <a href="login.php">Log In</a>
                    <a href="signup.php">Sign Up</a>
                ID_HTML;
        }
        ?>
        <a href="profile.php">Profile</a>
        <?php
        if ($_SESSION['usertype'] == 'C') {
            echo "<a href='courses.php'>Courses</a>";
        }
        ?>
        <a href="contactus.php">Contact Us</a>
        <a class="homelog" href="home.php" style="float:right;">khalia ala allah</a>
    </div>
    <?php
    if (isset($_SESSION['id'])) {
        $adname = $_SESSION['fullname'];
        echo "<br /><br /><br /><center><h2 style='color:white;'>Welcome $adname</h2></center>";
        echo <<<ID_HTML
        <div class="notification">
            <div class="notiglow"></div>
            <div class="notiborderglow"></div>
            <div class="notititle">
                Welcome to Khalia Ala Allah Academy
            </div>
            <div class="notibody">
                It is an academy specialized in educational programs,
                which provides many web development paths and learning programming in general with detailed interactive explanations,
                study plans with programming tests and challenges to ensure understanding and application of the code.
            </div>
        </div>
        <br />
        <center>
        <table>
        <tr>
        <td>
        <form class="search" action="home.php?s=1" method="post">
            <input class="searchbar" name="search" value placeholder="search in academy">
            <input class="searchsubmit" type="submit" name="searchok" value="search">
        </form>
        </td>
        ID_HTML;
        $q = "select type from course group by type";
        $arr = $pdo->query($q);
        $arr = $arr->fetchAll();
        echo "<td><form action='home.php?s=2' method='POST'><div class='custom-select'><select name='filtercourse'>";
        echo "<option value='all'>All</option>";
        foreach ($arr as $row) {
            $fc = $row['type'];
            echo "<option value='$fc'>$fc</option>";
        }
        echo "</select></div></td><td><input class='searchsubmit' type='submit' value='Ok' /></form></td></tr></table></center>";
        if ($_SESSION['usertype'] == 'C') {
            echo "<center><a href='showmybill.php'>Show my bill</a></center>";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['filtercourse']) && $_GET['s'] == 2) {
                    $t = $_POST['filtercourse'];
                    if ($t != 'all') {
                        $q = "SELECT * FROM course WHERE type='$t'";
                        $array = $pdo->query($q);
                        $array = $array->fetchAll();
                        $n = count($array);
                        echo "<center><h2>Found $n</h2></center><br />";
                        echo "<table border=1 class='tableid'>";
                        echo "<thead><th>Name</th><th>Type</th><th>Price</th><th>Time</th><th>Teacher</th><th>About course</th><th>Road Map</th><th>Pay</th></thead>";
                        foreach ($array as $row) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $price = $row['price'];
                            $time = $row['time'];
                            $type = $row['type'];
                            $teacher = $row['teacher'];
                            $about = $row['about'];
                            echo <<<ID_HTML
                                <tr>
                                <td>$name</td>
                                <td>$type</td>
                                <td>$price$</td>
                                <td>$time</td>
                                <td>$teacher</td>
                                <td>$about</td>
                                <td><a href='roadmap.php?cid=$id' style='color: #58afe6;'>Details</a></td>
                                <td>
                            ID_HTML;
                            $idd = $_SESSION['id'];
                            $qq = "select *  from bill where idu='$idd' AND idc='$id'";
                            $arrrr = $pdo->query($qq);
                            $arrrr = $arrrr->fetchall();
                            if (!count($arrrr)) {
                                echo "<a href='pay.php?cid=$id'>Pay</a>";
                            } else {
                                echo "<div style='color: green;'>paied</div>";
                            }
                            echo <<<ID_HTML
                                </td>
                                </tr>
                            ID_HTML;
                        }
                        echo "</table>";
                    } else {
                        $q = "SELECT * FROM course";
                        $array = $pdo->query($q);
                        $array = $array->fetchAll();
                        $n = count($array);
                        echo "<center><h2>Found $n</h2></center><br />";
                        echo "<table border=1 class='tableid'>";
                        echo "<thead><th>Name</th><th>Type</th><th>Price</th><th>Time</th><th>Teacher</th><th>About course</th><th>Road Map</th><th>Pay</th></thead>";
                        foreach ($array as $row) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $price = $row['price'];
                            $time = $row['time'];
                            $type = $row['type'];
                            $teacher = $row['teacher'];
                            $about = $row['about'];
                            echo <<<ID_HTML
                                <tr>
                                <td>$name</td>
                                <td>$type</td>
                                <td>$price$</td>
                                <td>$time</td>
                                <td>$teacher</td>
                                <td>$about</td>
                                <td><a href='roadmap.php?cid=$id' style='color: #58afe6;'>Details</a></td>
                                <td>
                            ID_HTML;
                            $idd = $_SESSION['id'];
                            $qq = "select *  from bill where idu='$idd' AND idc='$id'";
                            $arrrr = $pdo->query($qq);
                            $arrrr = $arrrr->fetchall();
                            if (!count($arrrr)) {
                                echo "<a href='pay.php?cid=$id'>Pay</a>";
                            } else {
                                echo "<div style='color: green;'>paied</div>";
                            }
                            echo <<<ID_HTML
                                </td>
                                </tr>
                            ID_HTML;
                        }
                        echo "</table>";
                    }
                } elseif (isset($_POST['search']) && $_GET['s'] == 1) {
                    $t = $_POST['search'];
                    $q = "SELECT * FROM course WHERE name='$t'";
                    $array = $pdo->query($q);
                    $array = $array->fetchAll();
                    $n = count($array);
                    if (count($array) == 0) {
                        echo "<center>Not found</center>";
                    } else {
                        echo "<center><h2>Found $n</h2></center><br />";
                        echo "<table border=1 class='tableid'>";
                        echo "<thead><th>Name</th><th>Type</th><th>Price</th><th>Time</th><th>Teacher</th><th>About course</th><th>Road Map</th><th>Pay</th></thead>";
                        $id = $array[0]['id'];
                        $name = $array[0]['name'];
                        $price = $array[0]['price'];
                        $time = $array[0]['time'];
                        $type = $array[0]['type'];
                        $teacher = $array[0]['teacher'];
                        $about = $array[0]['about'];
                        echo <<<ID_HTML
                                <tr>
                                <td>$name</td>
                                <td>$type</td>
                                <td>$price$</td>
                                <td>$time</td>
                                <td>$teacher</td>
                                <td>$about</td>
                                <td><a href='roadmap.php?cid=$id' style='color: #58afe6;'>Details</a></td>
                                <td>
                            ID_HTML;
                        $idd = $_SESSION['id'];
                        $qq = "select *  from bill where idu='$idd' AND idc='$id'";
                        $arrrr = $pdo->query($qq);
                        $arrrr = $arrrr->fetchall();
                        if (!count($arrrr)) {
                            echo "<a href='pay.php?cid=$id'>Pay</a>";
                        } else {
                            echo "<div style='color: green;'>paied</div>";
                        }
                        echo <<<ID_HTML
                            </td>
                            </tr>
                        ID_HTML;
                        echo "</table>";
                    }
                }
            } else {
                $q = "SELECT * FROM course";
                $array = $pdo->query($q);
                $array = $array->fetchAll();
                $n = count($array);
                echo "<center><h2>Found $n</h2></center><br />";
                echo "<table border=1 class='tableid'>";
                echo "<thead><th>Name</th><th>Type</th><th>Price</th><th>Time</th><th>Teacher</th><th>About course</th><th>Road Map</th><th>Pay</th></thead>";
                foreach ($array as $row) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $time = $row['time'];
                    $type = $row['type'];
                    $teacher = $row['teacher'];
                    $about = $row['about'];
                    echo <<<ID_HTML
                                <tr>
                                <td>$name</td>
                                <td>$type</td>
                                <td>$price$</td>
                                <td>$time</td>
                                <td>$teacher</td>
                                <td>$about</td>
                                <td><a href='roadmap.php?cid=$id' style='color: #58afe6;'>Details</a></td>
                                <td>
                        ID_HTML;
                    $idd = $_SESSION['id'];
                    $qq = "select *  from bill where idu='$idd' AND idc='$id'";
                    $arrrr = $pdo->query($qq);
                    $arrrr = $arrrr->fetchall();
                    if (!count($arrrr)) {
                        echo "<a href='pay.php?cid=$id'>Pay</a>";
                    } else {
                        echo "<div style='color: green;'>paied</div>";
                    }
                    echo <<<ID_HTML
                        </td>
                        </tr>
                    ID_HTML;
                }
                echo "</table>";
            }
        } else {
            echo "<center><h2 style='color:white;'>You are admin</h2></center>";
            echo "<center><a href='add.php'>Add course</a>  <a href='showallbill.php'>Show all bill</a></center>";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['filtercourse']) && $_GET['s'] == 2) {
                    $t = $_POST['filtercourse'];
                    if ($t != 'all') {
                        $q = "SELECT * FROM course WHERE type='$t'";
                        $array = $pdo->query($q);
                        $array = $array->fetchAll();
                        $n = count($array);
                        echo "<center><h2>Found $n</h2></center><br />";
                        echo "<table border=1 class='tableid'>";
                        echo "<thead><th>Name</th><th>Type</th><th>Price</th><th>Time</th><th>Teacher</th><th>About course</th><th>Road Map</th><th>Edit</th><th>Delete</th></thead>";
                        foreach ($array as $row) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $price = $row['price'];
                            $time = $row['time'];
                            $type = $row['type'];
                            $teacher = $row['teacher'];
                            $about = $row['about'];
                            echo <<<ID_HTML
                                <tr>
                                <td>$name</td>
                                <td>$type</td>
                                <td>$price$</td>
                                <td>$time</td>
                                <td>$teacher</td>
                                <td>$about</td>
                                <td><a href='roadmap.php?cid=$id' style='color: #58afe6;'>Details</a></td>
                                <td><a href='edit.php?cid=$id'&newnumvid=0 style='color: #9cb6e4;'>Edit</a></td>
                                <td><a href='Delete.php?cid=$id' style='color: red;' onclick="return confirm('Are you sure?')">Delete</a></td>
                                </tr>
                            ID_HTML;
                        }
                        echo "</table>";
                    } else {
                        $q = "SELECT * FROM course";
                        $array = $pdo->query($q);
                        $array = $array->fetchAll();
                        $n = count($array);
                        echo "<center><h2>Found $n</h2></center><br />";
                        echo "<table border=1 class='tableid'>";
                        echo "<thead><th>Name</th><th>Type</th><th>Price</th><th>Time</th><th>Teacher</th><th>About course</th><th>Road Map</th><th>Edit</th><th>Delete</th></thead>";
                        foreach ($array as $row) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $price = $row['price'];
                            $time = $row['time'];
                            $type = $row['type'];
                            $teacher = $row['teacher'];
                            $about = $row['about'];
                            echo <<<ID_HTML
                                <tr>
                                <td>$name</td>
                                <td>$type</td>
                                <td>$price$</td>
                                <td>$time</td>
                                <td>$teacher</td>
                                <td>$about</td>
                                <td><a href='roadmap.php?cid=$id' style='color: #58afe6;'>Details</a></td>
                                <td><a href='edit.php?cid=$id'&newnumvid=0 style='color: #9cb6e4;'>Edit</a></td>
                                <td><a href='Delete.php?cid=$id' style='color: red;' onclick="return confirm('Are you sure?')">Delete</a></td>
                                </tr>
                            ID_HTML;
                        }
                        echo "</table>";
                    }
                } elseif (isset($_POST['search']) && $_GET['s'] == 1) {
                    $t = $_POST['search'];
                    $q = "SELECT * FROM course WHERE name='$t'";
                    $array = $pdo->query($q);
                    $array = $array->fetchAll();
                    $n = count($array);
                    if (count($array) == 0) {
                        echo "<center>Not found</center>";
                    } else {
                        echo "<center><h2>Found $n</h2></center><br />";
                        echo "<table border=1 class='tableid'>";
                        echo "<thead><th>Name</th><th>Type</th><th>Price</th><th>Time</th><th>Teacher</th><th>About course</th><th>Road Map</th><th>Edit</th><th>Delete</th></thead>";
                        $id = $array[0]['id'];
                        $name = $array[0]['name'];
                        $price = $array[0]['price'];
                        $time = $array[0]['time'];
                        $type = $array[0]['type'];
                        $teacher = $array[0]['teacher'];
                        $about = $array[0]['about'];
                        echo <<<ID_HTML
                                <tr>
                                <td>$name</td>
                                <td>$type</td>
                                <td>$price$</td>
                                <td>$time</td>
                                <td>$teacher</td>
                                <td>$about</td>
                                <td><a href='roadmap.php?cid=$id' style='color: #58afe6;'>Details</a></td>
                                <td><a href='edit.php?cid=$id'&newnumvid=0 style='color: #9cb6e4;'>Edit</a></td>
                                <td><a href='Delete.php?cid=$id' style='color: red;' onclick="return confirm('Are you sure?')">Delete</a></td>
                                </tr>
                            ID_HTML;
                        echo "</table>";
                    }
                }
            } else {
                $q = "SELECT * FROM course";
                $array = $pdo->query($q);
                $array = $array->fetchAll();
                $n = count($array);
                echo "<center><h2>Found $n</h2></center><br />";
                echo "<table border=1 class='tableid'>";
                echo "<thead><th>Name</th><th>Type</th><th>Price</th><th>Time</th><th>Teacher</th><th>About course</th><th>Road Map</th><th>Edit</th><th>Delete</th></thead>";
                foreach ($array as $row) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $time = $row['time'];
                    $type = $row['type'];
                    $teacher = $row['teacher'];
                    $about = $row['about'];
                    echo <<<ID_HTML
                                <tr>
                                <td>$name</td>
                                <td>$type</td>
                                <td>$price$</td>
                                <td>$time</td>
                                <td>$teacher</td>
                                <td>$about</td>
                                <td><a href='roadmap.php?cid=$id' style='color: #58afe6;'>Details</a></td>
                                <td><a href='edit.php?cid=$id'&newnumvid=0 style='color: #9cb6e4;'>Edit</a></td>
                                <td><a href='Delete.php?cid=$id' style='color: red;' onclick="return confirm('Are you sure you want delete?')">Delete</a></td>
                                </tr>
                            ID_HTML;
                }
                echo "</table>";
            }
        }
    } else {
        echo <<<ID_HTML
            <br /><br /><br /><br /><br />
            <div class="notification">
                <div class="notiglow"></div>
                <div class="notiborderglow"></div>
                <div class="notititle">
                    Welcome to Khalia Ala Allah Academy
                </div>
                <div class="notibody">
                    You must log in to use the site
                </div>
            </div>
        ID_HTML;
        header("Location: login.php");
    }
    ?>
</body>

</html>