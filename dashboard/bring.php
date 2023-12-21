<?php 
include_once("connection.php");
$id = $_GET['id'];
$name = $_GET['name'];
$sql = "SELECT $name FROM offers WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
echo $row[$name];
?>