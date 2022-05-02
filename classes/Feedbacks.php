<?php
include_once 'Connection.php';
class Feedbacks {
   private $id;
   private $user_student_id;
   private $user_professor_id;
   private $msg;
   private $grade;
   private $created;
   function getId() {
       return $this->id;
   }

   function getUser_student_id() {
       return $this->user_student_id;
   }

   function getUser_professor_id() {
       return $this->user_professor_id;
   }

   function getMsg() {
       return $this->msg;
   }

   function getGrade() {
       return $this->grade;
   }

   function getCreated() {
       return $this->created;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setUser_student_id($user_student_id) {
       $this->user_student_id = $user_student_id;
   }

   function setUser_professor_id($user_professor_id) {
       $this->user_professor_id = $user_professor_id;
   }

   function setMsg($msg) {
       $this->msg = $msg;
   }

   function setGrade($grade) {
       $this->grade = $grade;
   }

   function setCreated($created) {
       $this->created = $created;
   }

      
   public function saveFeedback(){
       $connection = new Connection();
       date_default_timezone_set("Asia/Kolkata");
       $this->created = date('Y-m-d H:i:s');
       $query = "INSERT INTO feedbacks (user_student_id,user_professor_id,msg,grade,created) VALUES"
               . " ($this->user_student_id,$this->user_professor_id,'$this->msg','$this->grade','$this->created')";
       if($connection->allUpdateInsertDelete($query)){
            $type = "success";
            $msg = "<strong>Success !</strong> feedback saved  !";
            Session::setMessage($type, $msg);
        }else{
            $type = "danger";
            $msg = "<strong>Error !</strong> Unable to save  !";
            Session::setMessage($type, $msg);
        }
   }
   
   public function studentFeedback($id){
       $connection = new Connection();
       $query = "SELECT users.fname,users.lname,feedbacks.* FROM feedbacks INNER JOIN users ON "
               . "(users.id = feedbacks.user_professor_id) WHERE user_student_id = ".$id;
       $result = $connection->allSelect($query);
       return $result;
   }
   public function professorFeedback($id){
       $connection = new Connection();
       $query = "SELECT users.fname,users.lname,feedbacks.* FROM feedbacks INNER JOIN users ON "
               . "(users.id = feedbacks.user_student_id) WHERE user_professor_id = ".$id;
       $result = $connection->allSelect($query);
       return $result;
   }
   
   public function viewStudentFeedback($id){
       $connection = new Connection();
       $query = "SELECT users.fname,users.lname,feedbacks.* FROM feedbacks INNER JOIN users ON "
               . "(users.id = feedbacks.user_professor_id) WHERE user_student_id = $id AND feedbacks.id = ".$this->id;
       $result = $connection->allSelect($query);
       return $result;
   }
   public function viewProfessorFeedback($id){
       $connection = new Connection();
       $query = "SELECT users.fname,users.lname,feedbacks.* FROM feedbacks INNER JOIN users ON "
               . "(users.id = feedbacks.user_student_id) WHERE user_professor_id = $id AND feedbacks.id = ".$this->id;
       $result = $connection->allSelect($query);
       return $result;
   }
   
   public function viewAdminFeedback(){
       $connection = new Connection();
       $query = "SELECT users.fname,users.lname,feedbacks.* FROM feedbacks INNER JOIN users ON "
               . "(users.id = feedbacks.user_student_id) WHERE feedbacks.id = ".$this->id;
       $result = $connection->allSelect($query);
       return $result;
   }
   
   public function adminFeedback(){
        $connection = new Connection();
       $query = "SELECT users.fname,users.lname,feedbacks.* FROM feedbacks INNER JOIN users ON "
               . "(users.id = feedbacks.user_professor_id) ";
       $result = $connection->allSelect($query);
       return $result;
   }
   
   public function deleteFeedback(){
        $connection = new Connection();
        $query = "DELETE  FROM feedbacks where id = ".$this->id;
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
    
    public function searchFeedback($fname,$lname,$start,$end){
        $connection = new Connection();
        $fnameCondition = "";
        $lnameCondition = "";
        $dateCondition = "";
        if($fname=="" && $lname=="" && $start =="" && $end == ""){
            $query = "SELECT users.fname,users.lname,feedbacks.* FROM feedbacks INNER JOIN users ON "
               . "(users.id = feedbacks.user_professor_id)";
        }else{
            if($fname !=""){
                $fnameCondition = " users.fname = '$fname' AND";
            }
            if($lname !=""){
                $lnameCondition = " users.lname = '$lname' AND ";
            }
            if($start !="" && $end != ""){
                $start = date('Y-m-d',  strtotime($start));
                $end = date('Y-m-d',  strtotime($end));
                $dateCondition = "( feedbacks.created BETWEEN '$start' AND '$end' ) AND";
            }
                $query = "SELECT users.fname,users.lname,feedbacks.* FROM feedbacks INNER JOIN users ON "
               . "(users.id = feedbacks.user_professor_id) WHERE  $dateCondition  $fnameCondition $lnameCondition  1=1 ";
        }
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function feedbackCount(){
        $connection = new Connection();
        $query = "SELECT COUNT(*) as count FROM feedbacks";
        $result = $connection->allSelect($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['count'];
        }else{
            return 0;
        }
    }
}
