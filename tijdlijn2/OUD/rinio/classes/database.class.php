<?php

class Database {

    private static $objInstance;
    private $mysqli, $wakeup, $runned_queries = Array(), $log_path;
    private $host, $username, $password, $database;
    public $num_queries, $last_query, $insertid;
    private $CFG;

    // Create a connection with the database using mysqli
    private function __construct() {

        $this->host                  = 'localhost';
        $this->username          = 'tijdlijn';
        $this->password              = 'PADijburg01';
        $this->database              = 'u6488d13571_tijdlijn';

        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);

        $this->mysqli->query("SET NAMES utf8");

        if (!$this->mysqli || mysqli_connect_errno() != 0) {
            die('The database connection failed!');
        }

        // Disable autocommit
        //$this->mysqli->autocommit(false);

        // Set query logging path
        $this->log_path = '';
    }

    public static function getInstance() {

        if (!Database::$objInstance instanceof self) {
            Database::$objInstance = new self();
        }

        return Database::$objInstance;
    }

    function __wakeup() {

        $this->wakeup = true;
    }

    function autocommit($bool) {

        $this->mysqli->autocommit($bool);

    }

    function commit() {

        $this->mysqli->commit();

    }

    function rollback() {

        $this->mysqli->rollback();

    }

    // Execute a sql statement and keep track of it
    function _query($sql) {

        // Make sure data is saved correctly in UTF-8
        $sql = utf8_decode($sql);

        // Make a new connection when object is returning from serialize
        if ($this->wakeup) {
            $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
            $this->mysqli->query("SET NAMES utf8");
            $this->wakeup = false;
        }

        if (is_string($sql)) {

            if ($rs = $this->mysqli->query($sql)) {

                if ($this->mysqli->more_results()) {

                    $this->mysqli->next_result();

                }

                $this->num_queries++;
                $this->last_query = $sql;
                array_push($this->runned_queries, $sql);
                $this->insertid = $this->mysqli->insert_id;


            }

        } else {

            return true;

        }

        if ($rs) {

            return $rs;

        }

        return false;

    }

    // Create a procedure call
    function callProc($name, $params) {

        $sql = 'CALL ' . $name . '( ';
        if ($params) {
            $num_params = count($params);
            foreach ($params as $index => $param) {
                $comma = ($index + 1 != $num_params) ? ', ' : ' ';
                $sql .= '\'' . $param . '\'' . $comma . '';
            }
        }
        $sql .= ' );';

        return $this->_query($sql);
    }

    // Return the mysqli object for use in the mediator object
    function get_mysqli_object() {

        return $this->mysqli;
    }

    function realEscapeString($data) {

        if ($this->wakeup) {
            $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
            $this->wakeup = false;
        }
        $data = $this->mysqli->real_escape_string($data);

        return $data;
    }

    public function getRow($sql) {

        $return = array();

        $result = $this->_query($sql);

        if ($result->num_rows > 0) {

            $return = $result->fetch_assoc();

        }

        return $return;

    }

    public function getSet($sql) {

        $return = array();

        $result = $this->_query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $return[] = $row;

            }

        }

        return $return;

    }


    // Kill all variables and the mysqli object
    function __destruct() {

    }

}

?>