<?php 
    include_once("connection.php");
    class Offers {
        public static $id;
        public static $title;
        public static $description;
        public static $company;
        public static $location;
        public static $salary;
        public static $created_at;
        public static $admin_id;

        public function __construct($id, $title, $description, $company, $location, $salary, $created_at, $admin_id) {
            self::$id = $id;
            self::$title = $title;
            self::$description = $description;
            self::$company = $company;
            self::$location = $location;
            self::$salary = $salary;
            self::$created_at = $created_at;
            self::$admin_id = $admin_id;
        }
        public static function getOffers($connection) {
            $sql = "SELECT * FROM offers";
            $result = $connection->query($sql);
            return $result;
        }
        public static function addOffer($connection, $title, $description,  $location, $salary, $company ,$admin_id, $target) {
            $sql = "INSERT INTO offers (title, description,  location, company ,salary, admin_id, target ) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("sssssss", $title, $description,  $location, $company, $salary, $admin_id, $target);
            $stmt->execute();
        }
        public static function editOffer($connection, $id, $title, $description, $company, $location, $salary, $created_at, $admin_id , $target) {
            $sql = "UPDATE offers SET title = ?, description = ?, company = ?, location = ?, salary = ?, created_at = ?, admin_id = ? WHERE id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("sssssssi", $title, $description, $company, $location, $salary, $created_at, $admin_id, $id);
            $stmt->execute();
        }
        public static function deleteOffer($connection, $id) {
            $sql = "DELETE FROM offers WHERE id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
        public static function sendNotification($connection, $id, $user_id, $admin_id, $reponse) {
            $sql = "INSERT INTO inbox (offer_id,user_id,admin_id,reponse) VALUES (?,?,?,?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("iiis", $id, $user_id, $admin_id, $reponse);
            $stmt->execute();
        }
        public static function approve ($connection, $id) {
            $sql = "UPDATE offers SET status = 'Inactive' WHERE id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $sql2 = "UPDATE postules SET reponse = 'Approved' WHERE offer_id = ?";
            $stmt2 = $connection->prepare($sql2);
            $stmt2->bind_param("i", $id);
            $stmt2->execute();
        }
        public static function decline ($connection, $id) {
            $sql = "UPDATE postules SET reponse = 'Declined' WHERE offer_id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
    }
?>