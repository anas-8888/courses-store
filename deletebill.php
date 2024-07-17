<?php
require_once "connection.php";
session_start();
if(isset($_SESSION['id'])&&$_SESSION['usertype']=='A'){
    $bid = $_GET["bid"];
    $q = "DELETE FROM bill WHERE id='$bid';";
    $pdo->query($q);
    $pdo = NULL;
    header("Location: showallbill.php");
    exit();
}
