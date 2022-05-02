<?php
include_once 'Connection.php';
class Subjects {
   private $id;
   private $user_id;
   private $name;
   private $created;
   private $modified;
   
   function getId() {
       return $this->id;
   }

   function getUser_id() {
       return $this->user_id;
   }

   function getName() {
       return $this->name;
   }

   function getCreated() {
       return $this->created;
   }

   function getModified() {
       return $this->modified;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setUser_id($user_id) {
       $this->user_id = $user_id;
   }

   function setName($name) {
       $this->name = $name;
   }

   function setCreated($created) {
       $this->created = $created;
   }

   function setModified($modified) {
       $this->modified = $modified;
   }
   
   public function saveSubject(){
       $connection = new Connection();
       date_default_timezone_set("Asia/Kolkata");
       $this->created = date('Y-m-d H:i:s');
       $this->modified = date('Y-m-d H:i:s');
       $query = "INSERT INTO subjects (user_id,name,created,modified) VALUES "
               . "('$this->user_id','$this->name','$this->created','$this->modified')";
       if($connection->allUpdateInsertDelete($query)){
            $type = "success";
            $msg = "<strong>Success !</strong> record Save  !";
            Session::setMessage($type, $msg);
        }else{
            $type = "danger";
            $msg = "<strong>Error !</strong> Unable to save the record  !";
            Session::setMessage($type, $msg);
        }
   }
   
    public function selectAllSubject(){
        $connection = new Connection();
        $query = "SELECT users.fname,users.lname, subjects.* FROM subjects INNER JOIN users ON (users.id = subjects.user_id )";
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function searchSubject($fname){
        $connection = new Connection();
        $fnameCondition = "";
        $subjctCondition = "";
        if($this->name =="" && $fname==""){
            $query = "SELECT users.fname,users.lname, subjects.* FROM subjects INNER JOIN users ON (users.id = subjects.user_id )";
        }else{
            if($fname !=""){
                $fnameCondition = " users.fname = '$fname' AND";
            }
            if($this->name !=""){
                $subjctCondition = " subjects.name = '$this->name' AND";
            }
        $query = "SELECT users.fname,users.lname,subjects.* FROM subjects INNER JOIN users ON (users.id = subjects.user_id) where  $fnameCondition $subjctCondition  1=1 ";
        }
        $result = $connection->allSelect($query);
        return $result;
    }
    public function findById(){
        $connection = new Connection();
        $query = "SELECT * FROM subjects where id = ".$this->id;
        $result = $connection->allSelect($query);
        return $result;
    }
    public function editSubject(){
       $connection = new Connection();
       date_default_timezone_set("Asia/Kolkata");
       $this->modified = date('Y-m-d H:i:s');
       $query = "UPDATE subjects set user_id = '$this->user_id',name = '$this->name', modified ='$this->modified' WHERE id = ".$this->id;
       if($connection->allUpdateInsertDelete($query)){
            $type = "success";
            $msg = "<strong>Success !</strong> record updated  !";
            Session::setMessage($type, $msg);
        }else{
            $type = "danger";
            $msg = "<strong>Error !</strong> Unable to update the record  !";
            Session::setMessage($type, $msg);
        }
   }
   public function deleteSubject(){
        $connection = new Connection();
        $query = "DELETE  FROM subjects where id = ".$this->id;
        if($connection->allUpdateInsertDelete($query)){
                $type = "success";
                $msg = "<strong>Success !</strong> record deleted  !";
                Session::setMessage($type, $msg);
            }else{
                $type = "danger";
                $msg = "<strong>Error !</strong> Unable to delete the record  !";
                Session::setMessage($type, $msg);
            }
    }
    public function subjectCount(){
        $connection = new Connection();
        $query = "SELECT COUNT(*) as count FROM subjects";
        $result = $connection->allSelect($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['count'];
        }else{
            return 0;
        }
    }
}