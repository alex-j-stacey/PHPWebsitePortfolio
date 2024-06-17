<?php
session_start();
$errmsg = "";
$key = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

if ($_SESSION["Role"] != 1) {
    header("Location:index.php");
}

if(isset($_POST["submit"])) {
    if(empty($_POST["txtFName"])) {
        $errmsg = "Name is Required";
    } else {
        $FName = $_POST["txtFName"];
    }
    if(empty($_POST["txtEmail"])) {
        $errmsg = "Email is Required";
    } else {
        $Email = $_POST["txtEmail"];
    }
    if(empty($_POST["txtPassword"])) {
        $errmsg = "Password is Required";
    } else {
        $Password = $_POST["txtPassword"];
    }
    if(empty($_POST["txtRole"])) {
        $errmsg = "Role is Required";
    } else {
        $Role = $_POST["txtRole"];
    }

    if($Password != $_POST["txtPassword2"]) {
        $errmsg = "Passwords Do Not Match";
    }

    if($errmsg == "") {
        //do database work

        // db stuff
        include '../includes/dbConn.php';

        try {
            $db = new PDO($dsn, $username, $password, $options);

            $sql = $db->prepare("insert into memberLogin (memberName,memberEmail, memberPassword, roleID, memberKey) values (:Name, :Email, :Password, :RID, :Key)");
            $sql->bindValue(":Name",$FName);
            $sql->bindValue(":Email",$Email);
            $sql->bindValue(":Password",md5($Password . $key));
            $sql->bindValue(":RID",$Role);
            $sql->bindValue(":Key","$key");
            $sql->execute();

        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }

        $FName = "";
        $Email = "";
        $Password = "";
        $errmsg = "Member Added to Database";
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
    <h1>Admin Page</h1>
    <h3 id="error"><?=$errmsg?></h3>
    <form method="post">
        <table border="1" width="80%">
            <tr height="60">
                <th colspan="2"><h3>Add New Member</h3></th>
            </tr>
            <tr height="40">
                <th>Full Name</th>
                <td><input id="txtFName" name="txtFName" value="<?=$FName?>" type="text" size="50" ></td>
            </tr>
            <tr height="40">
                <th>Email</th>
                <td><input id="txtEmail" name="txtEmail" value="<?=$Email?>" type="text" size="50"></td>
            </tr>
            <tr height="40">
                <th>Password</th>
                <td><input id="txtPassword" name="txtPassword" type="password" size="50"></td>
            </tr>
            <tr height="40">
                <th>Retype Password</th>
                <td><input id="txtPassword2" name="txtPassword2" type="password" size="50"></td>
            </tr>
            <tr height="40">
                <th>Role</th>
                <td>
                    <select id="txtRole" name="txtRole">
                        <?php
                        include '../includes/dbConn.php';

                        try {
                            $db = new PDO($dsn, $username, $password, $options);

                            $sql = $db->prepare("select roleID, roleValue from role");

                            $sql->execute();
                            $results = $sql->fetch();

                            while ($results != null ) {
                                echo "<option value=" .$results["roleID"]. ">"  .$results["roleValue"]. "</option>";
                                $results = $sql->fetch();

                            }

                        } catch (PDOException $e) {
                            $error = $e->getMessage();
                            echo $error;
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr height="60">
                <td colspan="2"><input type="submit" value="Add New Member" name="submit"></td>
            </tr>

        </table>
    </form>
    <br/>
</main>
<footer><?php include '../includes/footer.php'?>
</footer>
</body>
</html>
