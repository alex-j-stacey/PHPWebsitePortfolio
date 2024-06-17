<?php

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        include '../includes/dbConn.php';
        $db = new PDO($dsn, $username, $password, $options);
        $sql = $db->prepare("delete from customerListing where CustomerID = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }
}
header("Location:customerlist.php");

?>