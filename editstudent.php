<?php
    if((!isset($_POST['id']) && (!isset($_GET['id'])))){
        exit();
    }
    include_once 'classes/Session.php';
    Session::start();
    if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
    include_once "classes/Students.php";

if(isset($_POST['branch'])){
        $student = new Students();
        $student->setId($_POST['id']);
        $student->setRoll_no($_POST['roll_no']);
        $student->setBranch($_POST['branch']);
        $student->setSemester($_POST['semester']);
        $student->setStart_year($_POST['start_year']);
        $student->setEnd_year($_POST['end_year']);
        $student->editStudent();
}
if(isset($_GET['id'])){
    $student = new Students();
    $student->setId($_GET['id']);
    $result = $student->getStudentById();
    if($result->num_rows <= 0){
        $type = "warning";
            $msg = "<strong>Warning !</strong> No record found !";
            Session::setMessage($type, $msg);
    }
}
include_once 'common.php';
$studentlist="active";
include  "header.php" ?>
<link rel="stylesheet" href="css/header.css" >
<!-- Start Feature Section -->
        <section id="feature" class="feature-section first-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <?php if($result->num_rows > 0){
                             $row = $result->fetch_assoc();
                             if($row['imgurl'] != ""){
                                 $imgurl = "profile/".$row['imgurl'];
                             }else{
                                 $imgurl = "profile/profile.png";
                             }
                            ?>
                        <div class="welcome-section">
                            <img class="img-circle" src="<?php echo $imgurl; ?>" >
                            <h4 class="text-center">
                                <?php echo $row['fname']." ".$row['lname']; ?>
                            </h4>
                            <div class="border"></div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="welcome-section">
                                <h4 class="text-center"> Edit Student </h4> 
                                <div class="border"></div>
                                <br/>
                                <?php echo Session::getMessage();?>
                                <?php if($result->num_rows > 0){ 
                                    ?>
                                    <form  enctype="multipart/form-data" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
                                     <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type='text' readonly="" class="form-control" value='<?php echo $row['fname']; ?>' />
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type='text' readonly="" class="form-control" value='<?php echo  $row['lname']; ?>' />
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type='text' readonly="" class="form-control" value='<?php echo $row['email']; ?>' />
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Roll Number</label>
                                            <input type="text" name="roll_no"  class="form-control" value="<?php echo $row['roll_no']; ?>" data-validate="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select class="form-control" name="branch" data-validate="required">
                                                <option value="">-- Select Branch --</option>
                                                <option value='CSE' <?php if($row['branch'] == "CSE") echo "selected"?>>CSE</option>
                                                <option value='IT' <?php if($row['branch'] == "IT") echo "selected"?>>IT</option>
                                                <option value='ME' <?php if($row['branch'] == "ME") echo "selected"?>>ME</option>
                                                <option value='CIVIL' <?php if($row['branch'] == "CIVIL") echo "selected"?>>CIVIL</option>
                                                <option value='EC' <?php if($row['branch'] == "EC") echo "selected"?>>EC</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select class="form-control" name="semester" data-validate="required">
                                                <option value="">-- Select Semester --</option>
                                                <option value='First' <?php if($row['semester'] == "First") echo "selected"?>>First Semester</option>
                                                <option value='Second' <?php if($row['semester'] == "Second") echo "selected"?>>Second Semester</option>
                                                <option value='Third' <?php if($row['semester'] == "Third") echo "selected"?>>Third Semester</option>
                                                <option value='Fourth' <?php if($row['semester'] == "Fourth") echo "selected"?>>Fourth Semester</option>
                                                <option value='Fifth' <?php if($row['semester'] == "Fifth") echo "selected"?>>Fifth Semester</option>
                                                <option value='Sixth' <?php if($row['semester'] == "Sixth") echo "selected"?>>Sixth Semester</option>
                                                <option value='Seventh' <?php if($row['semester'] == "Seventh") echo "selected"?>>Seventh Semester</option>
                                                <option value='Eighth' <?php if($row['semester'] == "Eighth") echo "selected"?>>Eighth Semester</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Start Year</label>
                                            <select class="form-control" name="start_year" data-validate="required">
                                                <option value="">-- Start Year --</option>
                                                <?php for($i=2000;$i <= 2050;$i++){ ?>
                                                        <option <?php if($row['start_year'] == $i) echo "selected" ?> value='<?php echo $i; ?>'><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>End Year</label>
                                            <select class="form-control" name="end_year" data-validate="required">
                                                <option value="">-- End Year --</option>
                                                <?php for($i=2000;$i <= 2050;$i++){ ?>
                                                        <option <?php if($row['end_year'] == $i) echo "selected" ?> value='<?php echo $i; ?>'><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <button type="submit" name="editstudent" class="btn btn-primary" id="editStudent" value="editstudent"><strong>Edit</strong></button>
                                        </div>
                                    </div>
                            </form>
                                <br/>
                                <?php } ?>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div>
        </section>
<?php include "footer.php"; ?>