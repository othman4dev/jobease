<?php
    class  DatabaseConnection {
        public  static function connect() {
          return  new mysqli("localhost", "root", "", "jobease");
        }
    }
    $connection =  DatabaseConnection::connect();
?>