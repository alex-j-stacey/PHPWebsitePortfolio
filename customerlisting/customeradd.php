<?php
session_start();
$key = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

if (isset($_POST["txtFirstName"])) {
    if (isset($_POST["txtLastName"])) {
        if (isset($_POST["txtPhoneNumber"])) {
            if (isset($_POST["txtEmail"])) {
                if (isset($_POST["txtAddress"])) {
                    if (isset($_POST["txtCity"])) {
                        if (isset($_POST["txtZipCode"])) {
                            if (isset($_POST["txtState"])) {
                                if (isset($_POST["txtPassword"])) {
                                    if (isset($_POST["txtPasswordConfirm"])) {
                                        $firstname = $_POST["txtFirstName"];
                                        $lastname = $_POST["txtLastName"];
                                        $phonenumber = $_POST["txtPhoneNumber"];
                                        $email = $_POST["txtEmail"];
                                        $address = $_POST["txtAddress"];
                                        $city = $_POST["txtCity"];
                                        $zipcode = $_POST["txtZipCode"];
                                        $state = $_POST["txtState"];
                                        $userpassword = $_POST["txtPassword"];
                                        $userpasswordconfirm = $_POST["txtPasswordConfirm"];

                                        // db stuff
                                        include '../includes/dbConn.php';

                                        try {
                                            $db = new PDO($dsn, $username, $password, $options);

                                            $sql = $db->prepare("insert into customerListing (FirstName,LastName,Address,City,State,Zip,Phone,Email,Password) values (:FirstName,:LastName,:Address,:City,:State,:Zip,:Phone,:Email,:Password)");
                                            $sql->bindValue(":FirstName",$firstname);
                                            $sql->bindValue(":LastName",$lastname);
                                            $sql->bindValue(":Address",$address);
                                            $sql->bindValue(":City",$city);
                                            $sql->bindValue(":State",$state);
                                            $sql->bindValue(":Zip",$zipcode);
                                            $sql->bindValue(":Phone",$phonenumber);
                                            $sql->bindValue(":Email",$email);
                                            $sql->bindValue(":Password",md5($userpassword . $key));
                                            $sql->execute();

                                        } catch (PDOException $e) {
                                            $error = $e->getMessage();
                                            echo "Error: $error";
                                        }

                                        header("Location:customerlist.php");
                                    }
                                }
                            }
                        }
                    }
                }
            }
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
    <style type="text/css">
        main {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        footer {
            text-align: center;
            padding-top: 100px;
        }
        form {
            background-color: grey;
            padding-top: 20px;

        }
        fieldset {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        legend {
            text-align: left;

        }
        table {
            margin: auto;
        }
    </style></head>
<body>

<main>
    <h1><strong>Create Account</strong></h1>
    <form method="post">
        <fieldset>
            <legend>Customer</legend>
            <table>
                <tr>
                    <th>First Name:</th>
                    <td><input type="text" id="txtFirstName" name="txtFirstName" ></td>
                </tr>
                <tr>
                    <th>Last Name:</th>
                    <td><input type="text" id="txtLastName" name="txtLastName" ></td>
                </tr>
                <tr>
                    <th>Phone Number:</th>
                    <td><input type="text" id="txtPhoneNumber" name="txtPhoneNumber" placeholder="(###)###-####"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" id="txtEmail" name="txtEmail" ></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Address</legend>
            <table>
                <tr>
                    <th>Address:</th>
                    <td><input type="text" id="txtAddress" name="txtAddress" ></td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td><input type="text" id="txtCity" name="txtCity" ></td>
                </tr>
                <tr>
                    <th>Zip Code:</th>
                    <td><input type="text" id="txtZipCode" name="txtZipCode" ></td>
                </tr>
                <tr>
                    <th>State</th>
                    <td><input type="text" id="txtState" name="txtState" placeholder="WI"></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Security</legend>
            <table>
                <tr>
                    <th>Password:</th>
                    <td><input type="text" id="txtPassword" name="txtPassword"></td>
                </tr>
                <tr>
                    <th>Password Verification:</th>
                    <td><input type="text" id="txtPasswordConfirm" name="txtPasswordConfirm" placeholder="re-enter password"></td>
                </tr>
            </table>
        </fieldset>
        <br />
        <input type="submit" value="Create Account" style="margin-bottom: 10px" >
    </form>
</main>
<footer><?php include '../includes/footer.php'?>
</footer>
</body>
</html>
