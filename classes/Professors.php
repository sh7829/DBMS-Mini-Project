<?php
include_once 'Connection.php';
class Professors {
    private $id;
    private $user_id;
    private $department;
    private $designation;
    private $status;
    private $created;
    private $modified;
    private $specification;
    
    function getId() {
        return $this->id;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getDepartment() {
        return $this->department;
    }

    function getDesignation() {
        return $this->designation;
    }

    function getStatus() {
        return $this->status;
    }

    function getCreated() {
        return $this->created;
    }

    function getModified() {
        return $this->modified;
    }

    function getSpecification() {
        return $this->specification;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setDepartment($department) {
        $this->department = $department;
    }

    function setDesignation($designation) {
        $this->designation = $designation;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setModified($modified) {
        $this->modified = $modified;
    }

    function setSpecification($specification) {
        $this->specification = $specification;
    }
    
    function saveProfessor(){
        date_default_timezone_set("Asia/Kolkata");
        $connection = new Connection();
        $this->user_id = Session::get('id');
        $this->created = date('Y-m-d H:i:s');
        $this->modified = date('Y-m-d H:i:s');
        $query = "INSERT INTO professors (user_id,department,designation,specification,status,created,modified) "
                . " VALUES($this->user_id,'$this->department','$this->designation','$this->specification','$this->status','$this->created','$this->modified')";
        
        if($connection->allUpdateInsertDelete($query)){
            $type = "success";
                $msg = " Record Saved ";
                Session::setMessage($type, $msg);
                header("Location:dashboard.php");
        }else{
            $type = "danger";
                $msg = "Unable to Save The Record ";
                Session::setMessage($type, $msg);
        }
    }
    
    function selectAllProfessor(){
        $connection = new Connection();
        $query = "SELECT users.fname,users.lname,users.email, professors.* FROM professors INNER JOIN users ON (users.id = professors.user_id )";
        $result = $connection->allSelect($query);
        return $result;
    }
    
    function selectProfessorByDepartment($department){
        $connection = new Connection();
        $query = "SELECT users.fname,users.lname,users.email, professors.* FROM professors INNER JOIN users ON (users.id = professors.user_id ) "
                . " WHERE (professors.department = 'ALL' OR professors.department = '$department' )";
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function searchProfessor($fname,$lname,$start,$end){
        $connection = new Connection();
        $counter = 0;
        $fnameCondition = "";
        $lnameCondition = "";
        $deptCondition = "";
        $dateCondition = "";
        if($this->department =="" && $fname=="" && $lname=="" && $start =="" && $end == ""){
            $query = "SELECT users.fname,users.lname,users.email, professors.* FROM professors INNER JOIN users ON (users.id = professors.user_id )";
        }else{
            if($fname !=""){
                $fnameCondition = " users.fname = '$fname' AND";
            }
            if($lname !=""){
                $lnameCondition = " users.lname = '$lname' AND ";
            }
            if($this->department !=""){
                $deptCondition = " professors.department = '$this->department' AND";
            }
            if($start !="" && $end != ""){
                $start = date('Y-m-d',  strtotime($start));
                $end = date('Y-m-d',  strtotime($end));
                $dateCondition = "( created BETWEEN '$start' AND '$end' ) AND";
            }
                $query = "SELECT users.fname,users.lname,users.email,professors.* FROM professors INNER JOIN users ON (users.id = professors.user_id) where  $dateCondition  $fnameCondition $lnameCondition $deptCondition  1=1 ";
        }
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function deleteProfessor(){
        $connection = new Connection();
        $query = "DELETE  FROM professors where id = ".$this->id;
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
    
    public function getProfessorById(){
        $connection = new Connection();
        $query = "SELECT users.fname,users.imgurl,users.lname,users.email,professors.* FROM professors INNER JOIN users ON (users.id = professors.user_id ) where professors.id = ".$this->id;
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function getProfessor(){
        $connection = new Connection();
        $query = "SELECT users.fname,users.imgurl,users.lname,users.email,users.address,users.dob,users.question,users.answer,users.mobile,users.gender,professors.* "
                . " FROM professors INNER JOIN users ON (users.id = professors.user_id ) where users.id = ".$this->id;
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function editProfessor(){
        date_default_timezone_set("Asia/Kolkata");
        $this->modified = date('Y-m-d H:i:s');
        $connection = new Connection();
        $query = " UPDATE professors SET department = '$this->department', designation='$this->designation',specification= '$this->specification' "
                . " WHERE id = ".$this->id;
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
    
    public function editByProfessor($imgArr,Users $user){
        $connection = new Connection();
        date_default_timezone_set("Asia/Kolkata");
        $this->modified = date('Y-m-d H:i:s');
        $user->modified = date('Y-m-d H:i:s');
        $imgCondition = "";
            if(!empty($imgArr) && $imgArr['error'] == 0){
                $user->imageUpload($imgArr);
                $imgCondition = ",imgurl = '$user->imgurl' ";
            }
        $queryProfessor = " UPDATE professors SET department = '$this->department', designation='$this->designation',specification= '$this->specification',"
                . "modified = '$this->modified' WHERE user_id = ".$this->id;
        $queryUser =  "UPDATE users SET fname='$user->fname',lname='$user->lname',gender='$user->gender',address='$user->address',"
                  . " question='$user->question',answer='$user->answer',dob='$user->dob',mobile='$user->mobile',modified='$user->modified' $imgCondition WHERE id=$this->id";
        
        if($connection->allUpdateInsertDelete($queryProfessor) && $connection->allUpdateInsertDelete($queryUser)){
                    Session::set('fname',$user->fname);
                    Session::set('lname',$user->lname);
                $type = "success";
                $msg = "<strong>Success !</strong> record updated  !";
                Session::setMessage($type, $msg);
            }else{
                $type = "danger";
                $msg = "<strong>Error !</strong> Unable to update the record  !";
                Session::setMessage($type, $msg);
            }
    }
    
    public function professorCount(){
        $connection = new Connection();
        $query = "SELECT COUNT(*) as count FROM professors";
        $result = $connection->allSelect($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['count'];
        }else{
            return 0;
        }
    }
     public function professorExist(){
        $connection = new Connection();
        $query = "SELECT COUNT(*) as count FROM professors where user_id = ".Session::get('id');
        $result = $connection->allSelect($query);
        if($result->num_rows > 0){
           $row = $result->fetch_assoc();
            if($row['count'] > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
