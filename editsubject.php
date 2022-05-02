<?php
    include_once 'common.php';
    include_once 'classes/Session.php';
    Session::start();
    if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
    include_once 'classes/Professors.php';
    include_once 'classes/Subjects.php';
    $professor = new Professors();
    $result = $professor->selectAllProfessor();
    $subject = new Subjects();
if(isset($_POST['name'])){
    $subject->setId($_POST['id']);
    $subject->setUser_id($_POST['user_id']);
    $subject->setName($_POST['name']);
    $subject->editSubject();
}

if(isset($_GET['id'])){
    $subject->setId($_GET['id']);
    $subjects = $subject->findById();
    if($subjects->num_rows <= 0){
       Session::setMessage("error"," Some Error !");
    }
}
$subjectlist ="active";
include  "header.php" ?>
<link rel="stylesheet" href="css/header.css" >
<!-- Start Feature Section -->
        <section id="feature" class="feature-section first-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="welcome-section">
                                <h4 class="text-center"> Edit Subject </h4> 
                                <div class="border"></div>
                                <br/>
                                <?php echo Session::getMessage();?>
                            <?php if($subjects->num_rows > 0){ 
                                $sub = $subjects->fetch_assoc();
                                ?>
                                <form  enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="id" value="<?php echo $sub['id']; ?>" >
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" data-validate="required" value="<?php echo $sub['name']; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <select class="form-control" data-validate="required" name="user_id">
                                            <option value="">-- Select Professor --</option>
                                            <?php if($result->num_rows > 0){
                                              while($row = $result->fetch_assoc()){ ?>
                                                  <option value="<?php echo $row['user_id'] ?>" <?php if($sub['user_id'] == $row['user_id']) echo "selected"; ?>><?php echo $row['fname']." ".$row['lname']; ?></option>
                                            <?php  }  
                                            }?>
                                        </select>  
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <button type="submit" name="send" class="btn btn-primary" ><strong>Edit</strong></button>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12"></div>
                </div><!-- /.row -->
            </div>
        </section>
<?php include "footer.php"; ?>