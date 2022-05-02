<?php
    if((!isset($_POST['id']) && (!isset($_GET['id'])))){
        exit();
    }
    include_once 'classes/Session.php';
    Session::start();
    if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
    include_once "classes/Professors.php";

if(isset($_POST['department'])){
        $professor = new Professors();
        $professor->setId($_POST['id']);
        $professor->setDepartment($_POST['department']);
        $professor->setDesignation($_POST['designation']);
        $professor->setSpecification($_POST['specification']);
        $professor->editProfessor();
}
if(isset($_GET['id'])){
    $professor = new Professors();
    $professor->setId($_GET['id']);
    $result = $professor->getProfessorById();
    if($result->num_rows <= 0){
        $type = "warning";
            $msg = "<strong>Warning !</strong> No record found !";
            Session::setMessage($type, $msg);
    }
}
include_once 'common.php';
$professorlist="active";
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
                                <h4 class="text-center"> Edit Professor </h4> 
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
                                            <input type='text' readonly="" class="form-control" value='<?php echo Session::get('fname'); ?>' />
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type='text' readonly="" class="form-control" value='<?php echo  Session::get('lname'); ?>' />
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type='text' readonly="" class="form-control" value='<?php echo Session::get('email'); ?>' />
                                        </div>
                                     </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select class="form-control" name="department" data-validate="required">
                                                <option value="">-- Select Department --</option>
                                                <option value='CSE' <?php if($row['department'] == "CSE") echo "selected"?>>CSE</option>
                                                <option value='IT' <?php if($row['department'] == "IT") echo "selected"?>>IT</option>
                                                <option value='ME' <?php if($row['department'] == "ME") echo "selected"?>>ME</option>
                                                <option value='CIVIL' <?php if($row['department'] == "CIVIL") echo "selected"?>>CIVIL</option>
                                                <option value='EC' <?php if($row['department'] == "EC") echo "selected"?>>EC</option>
                                                <option value='ALL' <?php if($row['department'] == "ALL") echo "selected"?>>ALL Department</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" name="designation"  value="<?php echo $row['designation']; ?>" class="form-control" placeholder="Enter Your Designation" data-validate="required" >
                                        </div>
                                    </div>
                                     <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Specification</label>
                                            <input type="text" name="specification" value="<?php echo $row['specification']; ?>"  class="form-control" placeholder="Your Specification" data-validate="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <button type="submit" name="editprofessor" class="btn btn-primary" id="editProfessor" ><strong>Edit</strong></button>
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