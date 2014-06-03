<?php
error_reporting(E_ALL);
include "dbcred.php";
include "DDMmobil.class.php";
//$myuuid = 'b710c14d6a29be70';
$myuuid = $_GET['myuuid'];
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
$DDMdata = new DDMmobil($dbh);
$DDMdata->removegoals($myuuid);
?>