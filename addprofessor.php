<?php
    include_once 'classes/Session.php';
    Session::start();
    if(!isset($_SESSION['id']) && Session::get('role') != 'Professor'){
        exit();
    }
    include_once "classes/Professors.php";
    $professor = new Professors();
if(isset($_POST['department'])){
        $professor->setDepartment($_POST['department']);
        $professor->setDesignation($_POST['designation']);
        $professor->setSpecification($_POST['specification']);
        $professor->setStatus(1);
        $professor->saveProfessor();
}
    if($professor->professorExist()){
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
                                <h4 class="text-center"> Professor Information </h4> 
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
                                            <select class="form-control" name="department" data-validate="required">
                                                <option value="">-- Select Department --</option>
                                                <option value='CSE'>CSE</option>
                                                <option value='IT'>IT</option>
                                                <option value='ME'>ME</option>
                                                <option value='CIVIL'>CIVIL</option>
                                                <option value='EC'>EC</option>
                                                <option value="ALL"> ALL Department</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="designation"  class="form-control" placeholder="Enter Your Designation" data-validate="required" >
                                        </div>
                                    </div>
                                     <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="specification"  class="form-control" placeholder="Your Specification" data-validate="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <button type="submit" name="addstudent" class="btn btn-primary" id="addProfessor"><strong>Submit</strong></button>
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