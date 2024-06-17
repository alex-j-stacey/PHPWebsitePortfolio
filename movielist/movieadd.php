<?php
if (isset($_POST["txtName"])) {
    if (isset($_POST["txtRating"])) {
        $title = $_POST["txtName"];
        $rating = $_POST["txtRating"];

        // db stuff
        include '../includes/dbConn.php';

        try {
            $db = new PDO($dsn, $username, $password, $options);

            $sql = $db->prepare("insert into movielist (movieTitle,movieRating) values (:Title, :Rating)");
            $sql->bindValue(":Title",$title);
            $sql->bindValue(":Rating",$rating);
            $sql->execute();

        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }

        header("Location:movielist.php");
    }
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
    <form method="post">
        <table border="1" width="80%">
            <tr height="60">
                <th colspan="2">Add New Movie</th>
            </tr>
            <tr height="40">
                <th>Movie Name</th>
                <td><input id="txtName" name="txtName" type="text" size="50"></td>
            </tr>
            <tr height="40">
                <th>Movie Rating</th>
                <td><input id="txtRating" name="txtRating" type="text" size="50"></td>
            </tr>
            <tr height="60">
                <td colspan="2"><input type="submit" value="Add New Movie"></td>
            </tr>
        </table>
    </form>
</main>
<footer><?php include '../includes/footer.php'?>
</footer>
</body>
</html>
