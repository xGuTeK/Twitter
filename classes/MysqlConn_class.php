<?php

class DB {
    
    private $DB_HOST = "localhost"; 
    protected $DB_USER = "root";
    protected $DB_PASS = "";
    protected $DB_NAME = "twiter";
    protected $conn;
    
    private function setDB_HOST($DB_HOST) {
        $this->DB_HOST = $DB_HOST;
    }

    private function setDB_USER($DB_USER) {
        $this->DB_USER = $DB_USER;
    }

    private function setDB_PASS($DB_PASS) {
        $this->DB_PASS = $DB_PASS;
    }

    private function setDB_NAME($DB_NAME) {
        $this->DB_NAME = $DB_NAME;
    }
    private function getDB_HOST() {
        return $this->DB_HOST;
    }

    private function getDB_USER() {
        return $this->DB_USER;
    }

    private function getDB_PASS() {
        return $this->DB_PASS;
    }

    private function getDB_NAME() {
        return $this->DB_NAME;
    }
    function setConn($conn) {
        $this->conn = $conn;
    }


                    
    /*public function __construct($DB_USER, $DB_PASS, $DB_NAME , $DB_HOST = 'localhost') {
        $this->setDB_HOST($DB_HOST);
        $this->setDB_NAME($DB_NAME);
        $this->setDB_USER($DB_USER);
        $this->setDB_PASS($DB_PASS);
        
        $this->connect();
    }*/
            
            
    public function connect() {
        $this->conn = new mysqli($this->getDB_HOST(), $this->getDB_USER(), $this->getDB_PASS(), $this->getDB_NAME());    
        if ($this->conn->connect_error){
            die("Database error. ");
        } else {       
            return $this->conn;
        } 
    
    }
    public function disconnect() {
        $this->connect()->close();
       
    }
}
        
  
    
    