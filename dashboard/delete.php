<?php 
    include "connection.php";
    $id = $_GET['id'];
    $query = "DELETE FROM offers WHERE `id` = '$id'";
    $result = mysqli_query($connection, $query);
    header("Location: Offers.php");
?>