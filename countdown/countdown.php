<?php
/*countdown to end of semester */

$secPerMin = 60;
$secPerHour = 60 * $secPerMin;
$secPerDay = 24 * $secPerHour;
$secPerYear = 365 * $secPerDay;

//current time
$now = time();

//end of semester
$endOfSemester = mktime(12,0,0,5,18,2024);

//seconds between now and then
$secondsUntil = $endOfSemester - $now;

$years = floor($secondsUntil / $secPerYear);
$secondsUntil = $secondsUntil - ($years * $secPerYear);

$days = floor($secondsUntil / $secPerDay);
$secondsUntil = $secondsUntil - ($days * $secPerDay);

$hours = floor($secondsUntil / $secPerHour);
$secondsUntil = $secondsUntil - ($hours * $secPerHour);

$minutes = floor($secondsUntil / $secPerMin);
$secondsUntil = $secondsUntil - ($minutes * $secPerMin);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alex's Homepage</title>
    <link type="text/css" rel="stylesheet" href="../css/base.css"
</head>
<body>
<header>
    <h1><?php include '../includes/header.php'?></h1>
</header>
<nav><?php include '../includes/nav.php'?></nav>
<main>
    <h2>End of Semester Countdown</h2>
    <p>Days: <?=$days ?>| Hours: <?=$hours?>| Minutes: <?=$minutes?>| Seconds: <?=$secondsUntil?></p>
</main>
<footer><?php include '../includes/footer.php'?>
</footer>
</body>
</html>

