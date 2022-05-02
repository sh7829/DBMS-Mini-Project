<?php
    include_once 'classes/Session.php';
    include_once 'common.php';
    Session::start();
    if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
    include_once 'classes/Users.php';
    include_once 'classes/Students.php';
    include_once 'classes/Subjects.php';
    include_once 'classes/Professors.php';
    include_once 'classes/Feedbacks.php';
    $user = new Users();
    $userCount = $user->userCount();
    $professor = new Professors();
    $profCount = $professor->professorCount();
    $student = new Students();
    $studCount = $student->studentCount();
    $subject= new Subjects();
    $subtCount= $subject->subjectCount();
    $feedback = new Feedbacks();
    $feedCount = $feedback->feedbackCount();
    $dashboard = "active";
include  "header.php" ?>
<link rel="stylesheet" href="css/header.css" >
<!-- Start Feature Section -->
        <section id="feature" class="feature-section first-section">
                <?php echo Session::getMessage();?>
    <!-- Start Fun Facts Section -->
    <section class="fun-facts container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                      <div class="counter-item">
                        <i class="fa fa-male"></i>
                        <div class="timer" id="item1" data-to="<?php echo  $studCount; ?>" data-speed="5000"></div>
                        <h5>Students</h5>                               
                      </div>
                    </div>  
                    <div class="col-xs-12 col-sm-6 col-md-3">
                      <div class="counter-item">
                        <i class="fa fa-male"></i>
                        <div class="timer" id="item2" data-to="<?php echo  $profCount; ?>" data-speed="5000"></div>
                        <h5>Professors</h5>                               
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                      <div class="counter-item">
                        <i class="fa fa-male"></i>
                        <div class="timer" id="item3" data-to="<?php echo  $userCount; ?>" data-speed="5000"></div>
                        <h5>Users</h5>                               
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                      <div class="counter-item">
                        <i class="fa fa-book"></i>
                        <div class="timer" id="item4" data-to="<?php echo  $feedCount; ?>" data-speed="5000"></div>
                        <h5>Feedbacks</h5>                               
                      </div>
                    </div>
            </div>
        </div>
    </section>
<!-- End Fun Facts Section -->
</section>
<?php include "footer.php"; ?>