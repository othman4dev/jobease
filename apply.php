<?php 
    session_start();
    include "verifyUser.php";

    if (isset($_GET['id'])) {
        $search = "SELECT * FROM postules WHERE offer_id = '" . $_GET['id'] . "' AND user_id = '" . $_SESSION['id'] . "'";
        $result = mysqli_query($connection, $search);
        if (mysqli_num_rows($result) > 0) {
            $errorcode = urlencode("You already applied for this job");
            header("Location: index.php?error=".$errorcode."");
        } else {
            $id = $_GET['id'];
            $user_id = $_SESSION['id'];
            $offer = User::getOffer($connection,$id,$user_id);
            $errorcode = urlencode("You already applied for this job");
            header("Location: index.php?good=".$errorcode."");
        }
    }
?>