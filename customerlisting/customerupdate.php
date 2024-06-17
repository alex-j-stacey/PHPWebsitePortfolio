<?php
include '../includes/dbConn.php';

if (isset($_POST["txtFirstName"])) {
    if (isset($_POST["txtLastName"])) {
        if (isset($_POST["txtPhoneNumber"])) {
            if (isset($_POST["txtEmail"])) {
                if (isset($_POST["txtAddress"])) {
                    if (isset($_POST["txtCity"])) {
                        if (isset($_POST["txtZipCode"])) {
                            if (isset($_POST["txtState"])) {

                                        $firstname = $_POST["txtFirstName"];
                                        $lastname = $_POST["txtLastName"];
                                        $phonenumber = $_POST["txtPhoneNumber"];
                                        $email = $_POST["txtEmail"];
                                        $address = $_POST["txtAddress"];
                                        $city = $_POST["txtCity"];
                                        $zipcode = $_POST["txtZipCode"];
                                        $state = $_POST["txtState"];
                                        $id = $_POST["txtID"];

                                        // db stuff

                                        try {
                                            $db = new PDO($dsn, $username, $password, $options);


                                            $sql = $db->prepare("update customerListing set FirstName = :FirstName, LastName = :LastName, Address = :Address, City = :City, State = :State, Zip = :Zip, Phone = :Phone, Email = :Email where CustomerID = :ID");
                                            $sql->bindValue(":FirstName",$firstname);
                                            $sql->bindValue(":LastName",$lastname);
                                            $sql->bindValue(":Address",$address);
                                            $sql->bindValue(":City",$city);
                                            $sql->bindValue(":State",$state);
                                            $sql->bindValue(":Zip",$zipcode);
                                            $sql->bindValue(":Phone",$phonenumber);
                                            $sql->bindValue(":Email",$email);
                                            $sql->bindValue(":ID",$id);
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

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        $db = new PDO($dsn, $username, $password, $options);
        $sql = $db->prepare("select * from customerListing where CustomerID = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
        $row = $sql->fetch();

        $firstname = $row["FirstName"];
        $lastname = $row["LastName"];
        $phonenumber = $row["Phone"];
        $email = $row["Email"];
        $address = $row["Address"];
        $city = $row["City"];
        $zipcode = $row["Zip"];
        $state = $row["State"];



    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }
}
else {
    header("Location:customerlist.php");
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
    </style>
    <script type="text/javascript">
        function DeleteCustomer(id) {
            if (confirm("Do you want to delete customer?")) {
                document.location.href = "customerdelete.php?id=" + id;
            }
        }
    </script>
</head>
<body>

<main>
    <h1><strong>Update Account</strong></h1>
    <form method="post">
        <fieldset>
            <legend>Customer</legend>
            <table>
                <tr>
                    <th>First Name:</th>
                    <td><input type="text" id="txtFirstName" name="txtFirstName" value="<?=$firstname?>"></td>
                </tr>
                <tr>
                    <th>Last Name:</th>
                    <td><input type="text" id="txtLastName" name="txtLastName" value="<?=$lastname?>"></td>
                </tr>
                <tr>
                    <th>Phone Number:</th>
                    <td><input type="text" id="txtPhoneNumber" name="txtPhoneNumber" placeholder="(###)###-####" value="<?=$phonenumber?>"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" id="txtEmail" name="txtEmail" value="<?=$email?>"></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Address</legend>
            <table>
                <tr>
                    <th>Address:</th>
                    <td><input type="text" id="txtAddress" name="txtAddress" value="<?=$address?>"></td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td><input type="text" id="txtCity" name="txtCity" value="<?=$city?>"></td>
                </tr>
                <tr>
                    <th>Zip Code:</th>
                    <td><input type="text" id="txtZipCode" name="txtZipCode" value="<?=$zipcode?>"></td>
                </tr>
                <tr>
                    <th>State</th>
                    <td><input type="text" id="txtState" name="txtState" placeholder="WI" value="<?=$state?>"></td>
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
        <input type="submit" value="Update Account" style="margin-bottom: 10px" >| <input type="button" onclick="DeleteCustomer('<?=$id?>')" value="Delete Account" />
        <input type="hidden" id="txtID" name="txtID" value="<?=$id?>" />
    </form>
</main>
<footer><?php include '../includes/footer.php'?>
</footer>
</body>
</html>
