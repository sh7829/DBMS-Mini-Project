<?php
    include_once 'classes/Session.php';
    Session::start();
    if(!isset($_SESSION['id']) && Session::get('role') != 'Student'){
        exit();
    }
    include_once "classes/Students.php";
    $student = new Students();
if(isset($_POST['branch'])){
        $student->setRoll_no($_POST['roll_no']);
        $student->setBranch($_POST['branch']);
        $student->setSemester($_POST['semester']);
        $student->setStart_year($_POST['start_year']);
        $student->setEnd_year($_POST['end_year']);
        $student->setStatus(1);
        $student->saveStudent();
}
if($student->studentExist()){
        header("location:stud_prof_feedback.php");
    }
include_once 'common.php';
$show="hidden";
include  "header.php" ?>
<link rel="stylesheet" href="css/header.css" >
<!-- Start Feature Section -->
        <section id="feature" class="feature-section first-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="welcome-section">
                                <h4 class="text-center"> Student Information </h4> 
                                <div class="border"></div>
                                <br/>
                                <?php echo Session::getMessage();?>
                                <form  enctype="multipart/form-data" method="post">
                                     <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <input type='text' readonly="" class="form-control" value='<?php echo Session::get('fname'); ?>' />
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <input type='text' readonly="" class="form-control" value='<?php echo  Session::get('lname'); ?>' />
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <input type='text' readonly="" class="form-control" value='<?php echo Session::get('email'); ?>' />
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="roll_no"  class="form-control" placeholder="Enter Roll Number" data-validate="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control" name="branch" data-validate="required">
                                                <option value="">-- Select Branch --</option>
                                                <option value='CSE'>CSE</option>
                                                <option value='IT'>IT</option>
                                                <option value='ME'>ME</option>
                                                <option value='CIVIL'>CIVIL</option>
                                                <option value='EC'>EC</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control" name="semester" data-validate="required">
                                                <option value="">-- Select Semester --</option>
                                                <option value='First'>First Semester</option>
                                                <option value='Second'>Second Semester</option>
                                                <option value='Third'>Third Semester</option>
                                                <option value='Fourth'>Fourth Semester</option>
                                                <option value='Fifth'>Fifth Semester</option>
                                                <option value='Sixth'>Sixth Semester</option>
                                                <option value='Seventh'>Seventh Semester</option>
                                                <option value='Eighth'>Eighth Semester</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control" name="start_year" data-validate="required">
                                                <option value="">-- Start Year --</option>
                                                <?php for($i=2000;$i <= 2050;$i++){ ?>
                                                        <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control" name="end_year" data-validate="required">
                                                <option value="">-- End Year --</option>
                                                <?php for($i=2000;$i <= 2050;$i++){ ?>
                                                        <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <button type="submit" name="addstudent" class="btn btn-primary" id="addStudent" ><strong>Submit</strong></button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12"></div>
                </div><!-- /.row -->
            </div>
        </section>
<?php include "footer.php"; ?>