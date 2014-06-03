<?php
error_reporting(E_ALL);
include "dbcred.php";
include "DDMmobil.class.php";
//$myuuid = 'b710c14d6a29be70';
$myuuid = $_GET['myuuid'];
$goals = $_GET['goals'];
$notes = $_GET['notes'];
$hours = $_GET['hours'];
$minutes = $_GET['minutes'];
$seconds = $_GET['seconds'];
$milage = $_GET['milage'];
$stars = $_GET['stars'];
$date = $_GET['date'];
$location = $_GET['location'];
$details = $_GET['details'];
$moreinfo = $_GET['moreinfo'];
$id = $_GET['id'];

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
$DDMdata = new DDMmobil($dbh);

//set goals http://palisades10k.com/app/goals.html
if (isset($_GET['submit']) && $_GET['submit'] == 'insertgoals') {
$DDMdata->setgoal($myuuid, $goals, $notes);
}

//log training http://palisades10k.com/app/log.html
if (isset($_GET['submit']) && $_GET['submit'] == 'logtrain') {
$DDMdata->logtrain($myuuid, $hours, $minutes, $seconds, $milage, $stars);
}

//insert event http://palisades10k.com/app/train.html
if (isset($_GET['submit']) && $_GET['submit'] == 'trainevent') {
$DDMdata->logevent($myuuid, $date, $location, $details, $moreinfo);
}

//insert event http://palisades10k.com/app/train.html
if (isset($_GET['submit']) && $_GET['submit'] == 'removegoals') {
	foreach ($id as $mygoal) {
		$DDMdata->removegoals2($mygoal);
	}
	echo 'Your goal was removed';
	//include 'index.html';
}

//insert event http://palisades10k.com/app/train.html
if (isset($_GET['submit']) && $_GET['submit'] == 'removeevents') {
	foreach ($id as $mygoal) {
		$DDMdata->removeEvent2($mygoal);
	}
	echo 'Your event was removed';
	//include 'index.html';
}


?>