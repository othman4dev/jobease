<?php
    include "connection.php";
    class User {
        public $sqlCheck = "SELECT * FROM users WHERE email = ?";
        public $sqlInsert = "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)";
        public $name;
        public $email;
        public $password_hash;
        public function __construct($email,$password_hash,$name) {
            $this->email = $email;
            $this->password_hash = password_hash($password_hash, PASSWORD_DEFAULT);
            $this->name = $name;
        }
        public function getUserInfo($conn) {
            $stmt = $conn->prepare($this->sqlCheck);
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        public function createUser($conn) {
            $stmt = $conn->prepare($this->sqlInsert);
            $stmt->bind_param("sss", $this->name, $this->email, $this->password_hash);
            $stmt->execute();
            return true;
        }
        public function login($conn,$email,$password_hash) {
            $stmt = $conn->prepare($this->sqlCheck);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                if (password_verify( $password_hash , $row['password_hash']) ) {
                    if ( $row['role'] == "admin" ) {
                        session_start();
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['role'] = $row['role'];
                        header("Location: dashboard/dashboard.php");
                    } else {
                        session_start();
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['role'] = $row['role'];
                        header("Location: index.php");
                    }
                } else {
                    $error = urlencode("Invalid username or password");
                    header("Location: login.php?error=$error");
                }
                
            } else {
                $error = urlencode("Invalid username or password");
                header("Location: login.php?error=$error");
            }
        }
        public static function getOffer($conn,$id,$user_id) {
            $sql = "INSERT INTO postules (user_id, offer_id) VALUES ('$user_id', '$id')";
            $result = mysqli_query($conn, $sql);
            return true;
        }
        public static function searchByKeywords($conn,$search) {
            $sql = "SELECT id FROM offers WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR location LIKE '%$search%' OR salary LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);
            $returned = json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
            return $returned;
        }
    }


    if(isset($_POST['login'])) {
        $user = new User ($_POST['email'],$_POST['password'],null);
        $user->login($connection,$_POST['email'],$_POST['password']);
}
    if (isset($_POST['register'])) {
        $user = new User ($_POST['email'],$_POST['password'],$_POST['name']);
        $result = $user->getUserInfo($connection);
        if ($result) {
            $error = urlencode("Email already exists");
            header("Location: register.php?error=$error");
        } else {
            $user->createUser($connection);
            header("Location: login.php");
        }
    }
?>