<?php
    session_start();

    $yourFirstRoll = mt_rand(1,6);
    $yourSecondRoll = mt_rand(1,6);
    $yourScore = $yourFirstRoll + $yourSecondRoll;

    $computerFirstRoll = mt_rand(1,6);
    $computerSecondRoll = mt_rand(1,6);
    $computerThirdRoll = mt_rand(1,6);
    $computerScore = $computerFirstRoll + $computerSecondRoll + $computerThirdRoll;

    $result = "";
    if ($yourScore > $computerScore)
    {
        $result = "You win!";
    }
    elseif ($computerScore > $yourScore)
    {
        $result = "You lose!";
    }
    else
    {
        $result = "It's a tie!";
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alex's Homepage</title>
    <link type="text/css" rel="stylesheet" href="../css/base.css">
</head>
<body>
<header>
    <h1><?php include '../includes/header.php'?></h1>
</header>
<nav><?php include '../includes/nav.php'?></nav>
<main>
    <h2>Dice Roll</h2>
    <h2>Your score: <?=$yourScore?></h2>
        <p>
            <img src="../images/dice_<?=$yourFirstRoll?>.png" />
            <img src="../images/dice_<?=$yourSecondRoll?>.png" />
        </p>
    <h2>Computer's score: <?=$computerScore?></h2>
        <p>
            <img src="../images/dice_<?=$computerFirstRoll?>.png" />
            <img src="../images/dice_<?=$computerSecondRoll?>.png" />
            <img src="../images/dice_<?=$computerThirdRoll?>.png" />
        </p>
    <h2>Result: <?=$result?></h2>

</main>
<footer><?php include '../includes/footer.php'?>
</footer>
</body>
</html>
