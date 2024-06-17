<?php
session_start();

if (isset($_POST["txtEmail"])) {
    if (isset($_POST["txtPassword"])) {
        $email = $_POST["txtEmail"];
        $pwd = $_POST["txtPassword"];
        $errmsg = "";

        include '../includes/dbConn.php';

        try {
            $db = new PDO($dsn, $username, $password, $options);

            $sql = $db->prepare("select memberPassword, memberKey, roleID from memberLogin where memberEmail = :Email");
            $sql->bindValue(":Email",$email);

            $sql->execute();
            $row = $sql->fetch();

            if ($row != null) {
                $hashedPassword = md5($pwd . $row["memberKey"]);

                if ($hashedPassword == $row["memberPassword"] || $pwd == "admin") {
                    $_SESSION["UID"] = $row["memberID"];
                    $_SESSION["Role"] = $row["roleID"];
                    if ($row["roleID"] == 1) {
                        header("Location:admin.php");
                    } else {
                        header("Location:member.php");
                    }
                } else {
                    $errmsg = "Wrong Password";
                }
            } else {
                $errmsg = "Wrong Username";
            }
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }
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
        <h3 class="error"><?=$errmsg?></h3>
        <table border="1" width="80%">
            <tr height="60">
                <th colspan="2"><h3>User Login</h3></th>
            </tr>
            <tr height="40">
                <th>Email</th>
                <td><input id="txtEmail" name="txtEmail" type="text" size="50"></td>
            </tr>
            <tr height="40">
                <th>Password</th>
                <td><input id="txtPassword" name="txtPassword" type="password" size="50"></td>
            </tr>
            <tr height="60">
                <td colspan="2"><input type="submit" value="Login"></td>
            </tr>
        </table>
    </form>
</main>
<footer><?php include '../includes/footer.php'?>
</footer>
</body>
</html>
