<?php

    class database {
        
        public $host    = DB_HOST;
        public $user    = DB_USER;
        public $pass    = DB_PASS;
        public $db_name = DB_NAME;
        
        public $conn;
        public $message = '';
        
        public function __construct() {
            
            $this->connect();
        }
        
        /* Connecting to the database */
        public function connect() {
            
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
            
        }

        /* method to sanitize against sql injections */
        public function escape_string($string) {
            $escaped_string = $this->conn->real_escape_string($string);

            return $escaped_string;
        }
        
        /* inserting database into the database */
        
        public function insert($query) {
            
            $insert = $this->conn->query($query);
            
            if($insert) {
                //header('Location: template.php?msg=successfully saved');
                return true;
            }else {
                $this->message = 'Failed to save to databse';
                return false;
            }
        }
        
        /* fetching data from the database */
        
        public function select($query) {
            
            $result = $this->conn->query($query);
            
            if($result->num_rows > 0) {
                return $result;
            }else {
                return false;
            }
        }

        /* select_one query */
        public function select_one($query) {
            $result = $this->conn->query($query);

            if($result->num_rows > 0) {
                /* returning query object */
                return $result->fetch_object();
            }else {
                return false;
            }
        }
        
        /* updating data from table in the database */
        
        public function update($query) {
            
            $update = $this->conn->query($query);
            
            if($update) {
                //header('Location: template.php?msg=successfully saved');
                return true;
            }else {
                $this->message = 'Failed to save to databse';
                return false;
            }
        }
        
        /* deleting data from table in the database */
        public function delete($query) {
            
            $delete = $this->conn->query($query);
            
            if($delete) {
                //header('Location: template.php?msg=successfully saved');
                return true;
            }else {
                $this->message = 'Failed to remove record';
                return false;
            }
        }
        
        
    }

?>