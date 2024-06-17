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
<header><h1><?php include '../includes/header.php'?></h1></header>
<nav><?php include '../includes/nav.php'?></nav>
<main>
    <?php

   $i = 1;
   while ($i < 7)
   {
       echo "<h$i>Hello World</h>";
       $i++;
   }

    $i = 6;
    do
    {
        echo "<h$i>Hello World</h>";
        $i--;
    } while ($i > 0);

    for($i=1;$i<7;$i++)
    {
        echo "<h$i>Hello World</h>";
    }

    echo "<br/><br/><hr/><br/>";
    $fullName = "Doug Smith";
    $position = strpos($fullName, ' ');

    echo $position;
    echo "<br/><br/><hr/><br/>";

    echo $fullName;
    echo "<br/>";

    $fullName = strtoupper($fullName);
    echo $fullName;

    echo "<br/>";
    $fullName = strtolower($fullName);
    echo $fullName;

    echo "<br/><br/><hr/><br/>";

    $nameParts = explode(' ', $fullName);
    echo $nameParts[0];
    echo $nameParts[1];


    ?>
</main>
<footer><?php include '../includes/footer.php'?></footer>
</body>
</html>
