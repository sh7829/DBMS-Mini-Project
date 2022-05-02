<?php
class Connection {
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "template";
        public function getConnection(){
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_errno){
                echo "Unable to connect with MySql";
                exit();
            }
            return $conn;
        }
        
        public function allUpdateInsertDelete($query){
            $conn = $this->getConnection();
            $status = $conn->query($query);
            $conn->close();
            return $status;
        }
        
        public function allSelect($query){
            $conn = $this->getConnection();
            $result = $conn->query($query);
            $conn->close();
            return $result;
        }
}