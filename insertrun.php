<?php
error_reporting(E_ALL);
include "dbcred.php";
include "DDMmobil.class.php";
$myuuid = 'b710c14d6a29be70';
//$morepath = 'this is morepath';
//$myuuid = $_GET['myuuid'];
$morepath = $_GET['morepath'];
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
$DDMdata = new DDMmobil($dbh);
$mymorepath=serialize($morepath);
$DDMdata->insertarun($myuuid, $mymorepath);
?>