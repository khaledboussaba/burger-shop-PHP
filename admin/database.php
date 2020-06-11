<?php

    class Database {

        private static $dbHsot = "localhost";
        private static $dbName = "burger_shop";
        private static $dbUser = "root";
        private static $dbUserPassword = "root";

        private static $connection = null;

        public static function connect() {

            try {
                self::$connection = new PDO("mysql:host=" . self::$dbHsot . ";dbname=" . self::$dbName, self::$dbUser, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }

            return self::$connection;

        }

        public static function disconnect() {
            self::$connection = null;
        }

    }

?>