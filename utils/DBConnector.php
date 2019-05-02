<?php
namespace DBConnector {
    class DBConnector
    {
        private $mysqliConnector;

        public function __construct($mysqliConnector)
        {
            if(!$mysqliConnector) {
                die('Could not connect: ');
             }
            $this->mysqliConnector = $mysqliConnector;
        }

        public function getQueryList($tableName) {
            $query = SELECT_QUERY.$tableName;
            $result = mysqli_query($this->mysqliConnector, $query);

            if ($result) {
                return $result;
            }

            die("System Busy");
        }

        public function getUser($tableName, $where) {
            $query = SELECT_QUERY.$tableName.$this->whereBuilder($where);
            $result = mysqli_query($this->mysqliConnector, $query);

            if ($result) {
                return $result;
            }

            die("System Busy");
        }

        public function getNumRows($queryResult) {
            return mysqli_num_rows($queryResult);
        }

        private function whereBuilder($where) {
            return " where ".$where;
        }

        public function fetchAssoc($result) {
            return mysqli_fetch_assoc($result);
        }

        public function close() {
            mysqli_close($this->mysqliConnector);
        }
    }

    class Builder
    {
        private static $username;

        private static $password;

        private static $host;

        private static $db;

        public static function host($host)
        {
            self::$host = $host;
            return new static;
        }

        public static function username($username)
        {
            self::$username = $username;
            return new static;
        }

        public static function password($password)
        {
            self::$password = $password;
            return new static;
        }

        public static function db($db)
        {
            self::$db = $db;
            return new static;
        }

        public static function build()
        {
            return new DBConnector(mysqli_connect(self::$host, self::$username, self::$password, self::$db));
        }
    }
}
