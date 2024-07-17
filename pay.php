<?php
require_once "connection.php";
session_start();
$uid = $_SESSION['id'];
$cid = $_GET["cid"];
$DateTime = date('Y-m-d H:i:s.000000');
$q = "INSERT INTO bill(idu,idc,date) VALUES(?, ?, ?)";
$ps = $pdo->prepare($q);
$ps->bindParam(1, $uid, PDO::PARAM_INT);
$ps->bindParam(2, $cid, PDO::PARAM_INT);
$ps->bindParam(3, $DateTime, PDO::PARAM_STR);
$ps->execute();
$pdo = NULL;
header("Location: roadmap.php?cid=$cid&&pn=1");
exit();
