<?php  
session_start();
include_once("connection.php");
include "admin.php";
$image;
$target;
if (isset($_FILES['image']['name'])) {
    $image = $_FILES['image']['name'];
    $target = "img/".uniqid().basename($image);
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $error = urlencode("Image uploaded successfully");
        header("Location: Offers.php?error=".$error);
    } else {
        $error = urlencode("Failed to upload image");
        header("Location: Offers.php?error=".$error);
    }
}
if (isset($_POST['submit'])) {
    Offers::addOffer($connection, $_POST['title'], $_POST['description'], $_POST['location'], $_POST['company'], $_POST['salary'], $_SESSION['id'], $target);
    header("Location: Offers.php");
}
?>