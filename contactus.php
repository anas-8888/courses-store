<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
    <title>Contact us</title>
</head>

<body>
    <div class="navbar">
        <?php
        session_start();
        if (isset($_SESSION['id'])) {
            echo <<<ID_HTML
                <a href="home.php">Home</a>
            ID_HTML;
        } else {
            echo <<<ID_HTML
                <a href="login.php">Log in</a>
                <a href="signup.php">Sign up</a>
            ID_HTML;
        }
        ?>
    </div>
    <br />
    <br />
    <br />
    <br />
    <center>
        <table border=1 class='tableid'>
            <tr>
                <td>
                    <center>
                        <a href="mailto:kilanyanas2@gmail.com">kilanyanas2@gmail.com</a>
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <a href="tel:+963964594375">+963-964594375</a>
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <a href="https://www.facebook.com/anas.kilane.5/">Company facebook</a>
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <a href="https://www.instagram.com/as._ki/?igsh=YTQwZjQ0NmI0OA%3D%3D">Company instagram</a>
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <a href="linkedin.com/in/anas-kilane-a53156226">Company likedin</a>
                    </center>
                </td>
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
</body>

</html>