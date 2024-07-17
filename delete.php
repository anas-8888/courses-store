<?php
require_once "connection.php";
session_start();
if(isset($_SESSION['id'])&&$_SESSION['usertype']=='A'){
    $uid = $_SESSION['id'];
    $cid = $_GET["cid"];
    $q = "DELETE FROM course WHERE id='$cid';";
    $pdo->query($q);
    $pdo = NULL;
    header("Location: home.php");
    exit();
}
