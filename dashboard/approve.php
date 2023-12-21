<?php  
    session_start();
    include_once("connection.php");
    include "admin.php";
    $id = $_GET['id'];
    $user = $_GET['user'];
    Offers::approve($connection, $id);
    Offers::sendNotification($connection, $id ,$user, $_SESSION['id'],'Approved');
    header("Location: postules.php");
?>