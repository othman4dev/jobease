<?php 
include "connection.php";
$id = $_GET['id'];
$query = "DELETE FROM users WHERE `id` = '$id'";
$result = mysqli_query($connection, $query);
header("Location: candidat.php");
?>