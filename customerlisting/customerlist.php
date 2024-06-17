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
            text-align: center;
        }
        footer {
            text-align: center;
            padding-top: 100px;
        }
    </style>
</head>
<body>
<main width="100%">
    <h2>Customer Listing</h2>
    <table border="1" width="100%" >
        <tr>
            <th>CustomerID</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>zip</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Password</th>
        </tr>

    <?php
        include '../includes/dbConn.php';

        try {
            $db = new PDO($dsn, $username, $password, $options);

            $sql = $db->prepare("select * from customerListing");
            $sql->execute();
            $row = $sql->fetch();

            while ($row != null ) {
                echo "<tr>";
                    echo "<td><a href=customerupdate.php?id=" .$row["CustomerID"]. ">". $row["CustomerID"] ."</a></td>";
                    echo "<td>". $row["FirstName"] ."</td>";
                    echo "<td>". $row["LastName"] ."</td>";
                    echo "<td>". $row["Address"] ."</td>";
                    echo "<td>". $row["City"] ."</td>";
                    echo "<td>". $row["State"] ."</td>";
                    echo "<td>". $row["Zip"] ."</td>";
                    echo "<td>". $row["Phone"] ."</td>";
                    echo "<td>". $row["Email"] ."</td>";
                    echo "<td>". $row["Password"] ."</td>";
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
    <a href="customeradd.php">Add New Customer</a>
</main>
<footer><?php include '../includes/footer.php'?>
</footer>
</body>
</html>
