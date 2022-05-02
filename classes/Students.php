<?php
include_once 'Connection.php';
class Students {
    private $id;
    private $user_id;
    private $branch;
    private $start_year;
    private $end_year;
    private $semester;
    private $status;
    private $created;
    private $modified;
    private $roll_no;
    
    function getId() {
        return $this->id;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getBranch() {
        return $this->branch;
    }

    function getStart_year() {
        return $this->start_year;
    }

    function getEnd_year() {
        return $this->end_year;
    }

    function getSemester() {
        return $this->semester;
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

    function getRoll_no() {
        return $this->roll_no;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setBranch($branch) {
        $this->branch = $branch;
    }

    function setStart_year($start_year) {
        $this->start_year = $start_year;
    }

    function setEnd_year($end_year) {
        $this->end_year = $end_year;
    }

    function setSemester($semester) {
        $this->semester = $semester;
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

    function setRoll_no($roll_no) {
        $this->roll_no = $roll_no;
    }

        
    function saveStudent(){
        date_default_timezone_set("Asia/Kolkata");
        $connection = new Connection();
        $this->user_id = Session::get('id');
        $this->created = date('Y-m-d H:i:s');
        $this->modified = date('Y-m-d H:i:s');
        $query = "INSERT INTO students(user_id,roll_no,branch,semester,start_year,end_year,status,created,modified) "
                . " VALUES($this->user_id,'$this->roll_no','$this->branch','$this->semester','$this->start_year','$this->end_year','$this->status','$this->created','$this->modified')";
        
        if($connection->allUpdateInsertDelete($query)){
            $type = "success";
                $msg = "Student Record Saved ";
                Session::setMessage($type, $msg);
                header("Location:dashboard.php");
        }else{
            $type = "danger";
                $msg = "Unable to Save The Student Record ";
                Session::setMessage($type, $msg);
        }
    }
    
    function selectAllStudent(){
        $connection = new Connection();
        $query = "SELECT users.fname,users.lname,users.email, students.* FROM students INNER JOIN users ON (users.id = students.user_id )";
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function searchStudent($fname,$lname,$start,$end){
        $connection = new Connection();
        $counter = 0;
        $fnameCondition = "";
        $lnameCondition = "";
        $rollCondition = "";
        $dateCondition = "";
        if($this->roll_no =="" && $fname=="" && $lname=="" && $start =="" && $end == ""){
            $query = "SELECT users.fname,users.lname,users.email, students.* FROM students INNER JOIN users ON (users.id = students.user_id )";
        }else{
            if($fname !=""){
                $fnameCondition = " users.fname = '$fname' AND";
            }
            if($lname !=""){
                $lnameCondition = " users.lname = '$lname' AND ";
            }
            if($this->roll_no !=""){
                $rollCondition = " students.roll_no = '$this->roll_no' AND";
            }
            if($start !="" && $end != ""){
                $start = date('Y-m-d',  strtotime($start));
                $end = date('Y-m-d',  strtotime($end));
                $dateCondition = "( created BETWEEN '$start' AND '$end' ) AND";
            }
                $query = "SELECT users.fname,users.lname,users.email,students.* FROM students INNER JOIN users ON (users.id = students.user_id) where  $dateCondition  $fnameCondition $lnameCondition $rollCondition  1=1 ";
        }
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function deleteStudent(){
        $connection = new Connection();
        $query = "DELETE  FROM students where id = ".$this->id;
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
    public function getStudentById(){
        $connection = new Connection();
        $query = "SELECT users.fname,users.imgurl,users.lname,users.email,users.address,users.dob,users.question,users.answer,users.mobile,users.gender,students.* "
                . " FROM students INNER JOIN users ON (users.id = students.user_id ) where students.id = ".$this->id;
        $result = $connection->allSelect($query);
        return $result;
    }
    public function getStudent(){
        $connection = new Connection();
        $query = "SELECT users.fname,users.imgurl,users.lname,users.email,users.address,users.dob,users.question,users.answer,users.mobile,users.gender,students.* "
                . " FROM students INNER JOIN users ON (users.id = students.user_id ) where users.id = ".$this->id;
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function editStudent(){
        date_default_timezone_set("Asia/Kolkata");
        $this->modified = date('Y-m-d H:i:s');
        $connection = new Connection();
        $query = " UPDATE students SET roll_no = '$this->roll_no', branch='$this->branch',semester= '$this->semester',"
                . "start_year = '$this->start_year', end_year='$this->end_year' WHERE id = ".$this->id;
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
    
    public function editByStudent($imgArr,Users $user){
        $connection = new Connection();
        date_default_timezone_set("Asia/Kolkata");
        $this->modified = date('Y-m-d H:i:s');
        $user->modified = date('Y-m-d H:i:s');
        $imgCondition = "";
            if(!empty($imgArr) && $imgArr['error'] == 0){
                $user->imageUpload($imgArr);
                $imgCondition = ",imgurl = '$user->imgurl' ";
            }
        $queryStudent = " UPDATE students SET roll_no = '$this->roll_no', branch='$this->branch',semester= '$this->semester',"
                . "start_year = '$this->start_year', end_year='$this->end_year',modified = '$this->modified' WHERE user_id = ".$this->id;
        $queryUser =  "UPDATE users SET fname='$user->fname',lname='$user->lname',gender='$user->gender',address='$user->address',"
                  . " question='$user->question',answer='$user->answer',dob='$user->dob',mobile='$user->mobile',modified='$user->modified' $imgCondition WHERE id=$this->id";
        
        if($connection->allUpdateInsertDelete($queryStudent) && $connection->allUpdateInsertDelete($queryUser)){
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
    
    public function getStudentData($id){
        $connection = new Connection();
        $query = "SELECT * FROM students where user_id = ".$id;
        $result = $connection->allSelect($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }else{
            return false;
        }
    }
    
    public function studentCount(){
        $connection = new Connection();
        $query = "SELECT COUNT(*) as count FROM students";
        $result = $connection->allSelect($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['count'];
        }else{
            return 0;
        }
    }
    
    public function studentExist(){
        
        $connection = new Connection();
        $query = "SELECT COUNT(*) as count FROM students where user_id = ".Session::get('id');
        echo $query;
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
