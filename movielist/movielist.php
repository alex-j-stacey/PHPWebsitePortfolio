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
    <h2>My Movie List</h2>
    <table border="1" width="80%" >
        <tr>
            <th>Key</th>
            <th>Movie Title</th>
            <th>Rating</th>
        </tr>

    <?php
        include '../includes/dbConn.php';

        try {
            $db = new PDO($dsn, $username, $password, $options);

            $sql = $db->prepare("select * from movielist");
            $sql->execute();
            $row = $sql->fetch();

            while ($row != null ) {
                echo "<tr>";
                    echo "<td>". $row["movieID"] ."</td>";
                    echo "<td><a href=movieupdate.php?id=" .$row["movieID"]. ">". $row["movieTitle"] ."</a></td>";
                    echo "<td>". $row["movieRating"] ."</td>";
                echo "</tr>";

                $row = $sql->fetch();
            }

        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }
    ?>
    </table>
    <br /> <br />
    <a href="movieadd.php">Add New Movie</a>
</main>
<footer><?php include '../includes/footer.php'?>
</footer>
</body>
</html>
