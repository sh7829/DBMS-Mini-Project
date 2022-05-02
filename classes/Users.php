<?php
include_once 'Connection.php';
class Users{
        public $id;
        public $fname;
        public $lname;
        public $mobile;
        public $address;
        public $gender;
        public $email;
        public $dob;
        private $password;
        public $question;
        public $answer;
        private $role;
        public $imgurl;
        private $status;
        public $created;
        public $modified;
        
        function getId() {
            return $this->id;
        }

        function getFname() {
            return $this->fname;
        }

        function getLname() {
            return $this->lname;
        }

        function getMobile() {
            return $this->mobile;
        }

        function getAddress() {
            return $this->address;
        }

        function getGender() {
            return $this->gender;
        }

        function getEmail() {
            return $this->email;
        }

        function getDob() {
            return $this->dob;
        }

        function getPassword() {
            return $this->password;
        }

        function getQuestion() {
            return $this->question;
        }

        function getAnswer() {
            return $this->answer;
        }

        function getRole() {
            return $this->role;
        }

        function getImgurl() {
            return $this->imgurl;
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

        function setId($id) {
            $this->id = $id;
        }

        function setFname($fname) {
            $this->fname = $fname;
        }

        function setLname($lname) {
            $this->lname = $lname;
        }

        function setMobile($mobile) {
            $this->mobile = $mobile;
        }

        function setAddress($address) {
            $this->address = $address;
        }

        function setGender($gender) {
            $this->gender = $gender;
        }

        function setEmail($email) {
            $this->email = $email;
        }

        function setDob($dob) {
            $this->dob = $dob;
        }

        function setPassword($password) {
            $this->password = $password;
        }

        function setQuestion($question) {
            $this->question = $question;
        }

        function setAnswer($answer) {
            $this->answer = $answer;
        }

        function setRole($role) {
            $this->role = $role;
        }

        function setImgurl($imgurl) {
            $this->imgurl = $imgurl;
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
                
        public function saveUser($imgArr = array()){
            date_default_timezone_set("Asia/Kolkata");
            $connection = new Connection();
            $this->imgurl = "";
            if(!empty($imgArr)){
                $this->imageUpload($imgArr);
            }
           $this->created =  date('Y-m-d H:i:s');
           $this->modified = date('Y-m-d H:i:s');
            $query = "INSERT INTO users (fname,lname,mobile,gender,email,address,dob,password,question,answer,role,imgurl,status,created,modified)"
                    . " VALUES ('$this->fname','$this->lname','$this->mobile','$this->gender','$this->email','$this->address','$this->dob',"
                    . "'$this->password',$this->question,'$this->answer','$this->role','$this->imgurl',$this->status,'$this->created','$this->modified')";
            if($connection->allUpdateInsertDelete($query)){
                $this->userLogin();
            }else{
                $type = "danger";
                $msg = "Some error try again  !";
                Session::setMessage($type, $msg);
            }
        }
    
    public function selectAllUser(){
        $connection = new Connection();
        $query = "SELECT * FROM users ";
        $result = $connection->allSelect($query);
        return $result;
    }
    public function checkEmail(){
        $connection = new Connection();
        $query = "SELECT count(*) as count from users where email = '$this->email' ";
        $result = $connection->allSelect($query);
        return $result;
    }
    
    public function selectUserByDate($start,$end){
        $connection = new Connection();
        $counter = 0;
        $fnameCondition = "";
        $lnameCondition = "";
        $mobileCondition = "";
        $dateCondition = "";
        if($this->mobile =="" && $this->fname=="" && $this->lname=="" && $start =="" && $end == ""){
            $query = "SELECT * FROM users ";
        }else{
            if($this->fname !=""){
                $fnameCondition = " fname = '$this->fname' AND";
            }
            if($this->lname !=""){
                $lnameCondition = " lname = '$this->lname' AND ";
            }
            if($this->mobile !=""){
                $mobileCondition = " mobile = '$this->mobile' AND";
            }
            if($start !="" && $end != ""){
                $start = date('Y-m-d',  strtotime($start));
                $end = date('Y-m-d',  strtotime($end));
                $dateCondition = "( created BETWEEN '$start' AND '$end' ) AND";
            }
                $query = "SELECT * FROM users where  $dateCondition  $fnameCondition $lnameCondition $mobileCondition  1=1 ";
        }
        $result = $connection->allSelect($query);
        return $result;
    }
    public function editUser($imgArr = Array()){
        date_default_timezone_set("Asia/Kolkata");
        $this->modified = date('Y-m-d H:i:s');
         $connection = new Connection();
         $imgCondition = "";
         $extraField = "";
            if(!empty($imgArr) && $imgArr['error'] == 0){
                $this->imageUpload($imgArr);
                $imgCondition = ",imgurl = '$this->imgurl' ";
            }
         if(strlen($this->role) > 0){
             $extraField = ",status = '$this->status',role = '$this->role' ";
         }
          $query = "UPDATE users SET fname='$this->fname',lname='$this->lname',gender='$this->gender',address='$this->address',"
                  . " question='$this->question',answer='$this->answer',dob='$this->dob',mobile='$this->mobile',modified='$this->modified' $extraField  $imgCondition where id=$this->id";
            if($connection->allUpdateInsertDelete($query)){
                if(Session::get('id') == $this->id){
                    Session::set('fname',$this->fname);
                    Session::set('lname',$this->lname);
                    Session::set('role',$this->role);
                }
                $type = "success";
                $msg = "<strong>Success !</strong> record updated  !";
                Session::setMessage($type, $msg);
            }else{
                $type = "danger";
                $msg = "<strong>Error !</strong> Unable to update the record  !";
                Session::setMessage($type, $msg);
            }
    }
    
    public function deleteUser(){
        $connection = new Connection();
        $query = "DELETE  FROM users where id = ".$this->id;
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
    public function getUserById(){
        $connection = new Connection();
        $query = "SELECT * FROM users where id = ".$this->id;
        $result = $connection->allSelect($query);
        return $result;
    }


    public function imageUpload($imgArr = array()){
        if(!empty($imgArr)){
            if($imgArr['error'] == 0){
                $imgName = $imgArr['name'];
                $imgSize = $imgArr['size'];
                $imgType = $imgArr['type'];
                $imgTemp = $imgArr['tmp_name'];
                $imgRename = rand(0,999999).$imgName;
                $destination = "profile/".$imgRename;
                if(move_uploaded_file($imgTemp, $destination)){
                    $this->imgurl = $imgRename;
                }
            }
        }
    }
    
    public function userLogin(){
        $connection = new Connection();
        $query = "SELECT * FROM users WHERE email='$this->email' AND password='$this->password' ";
        $result = $connection->allSelect($query);
        if($result->num_rows > 0){
          $row = $result->fetch_assoc();
          //error_reporting(0);
          Session::set('id',$row['id']);
          Session::set('email',$row['email']);
          Session::set('fname',$row['fname']);
          Session::set('lname',$row['lname']);
          Session::set('role',$row['role']);
          Session::set('imgurl',$row['imgurl']);
            if($row['role'] == "Admin"){
              header("Location:dashboard.php");
              
            }else if($row['role'] == "Professor" ){
                header("Location:addprofessor.php");
                
            }else if($row['role'] == "Student"){
                header("Location:addstudent.php");
                
            }else{
                header("Location:logout.php");
            }
        }else{
            $type = "danger";
            $msg = "<strong>Error !</strong> email or password not matched !";
            Session::setMessage($type, $msg);
        }
    }
    
    public function userLogout(){
        Session::reset();
        Session::destroy();
        header("Location:login.php");
    }
    
    public function forgotPassword(){
        $connection = new Connection();
        $query = "SELECT * FROM users WHERE email='$this->email' AND question=$this->question AND answer = '$this->answer'  ";
        $result = $connection->allSelect($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $hased = '';
            for ($i = 0; $i < 8; $i++){
                $hased .= $characters[mt_rand(0, 61)];
            }
            $this->setPassword($hased);
            $this->setId($row['id']);
            if($this->updatePassword()){
                $type = "success";
                $msg = "Success ! </strong> Your password is <font style='color:black'>".$hased."</font>";
                Session::setMessage($type, $msg);
            }else{
                $type = "danger";
                $msg = "<strong>Error !</strong> Unable to recover the password !";
                Session::setMessage($type, $msg);
            }
        }else{
            $type = "danger";
            $msg = "<strong>Error !</strong> Unable to recover the password !";
            Session::setMessage($type, $msg);
        }
    }
    
    public function updatePassword(){
        $connection = new Connection();
        $query = "UPDATE users SET password= '$this->password' WHERE id=$this->id";
        if($connection->allUpdateInsertDelete($query)){
            return true;
        }else{
            return false;
        }
    }  
    
    public function userCount(){
        $connection = new Connection();
        $query = "SELECT COUNT(*) as count FROM users";
        $result = $connection->allSelect($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['count'];
        }else{
            return 0;
        }
    }
}