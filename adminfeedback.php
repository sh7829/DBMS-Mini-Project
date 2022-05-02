<?php 
    include_once 'classes/Session.php';
    Session::start();
    if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
    include_once "classes/Feedbacks.php";
    include_once "classes/Users.php";
    include_once 'common.php';
    $feedback = new Feedbacks();
    $result = $feedback->adminFeedback();
    if(isset($_POST['fname'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $result = $feedback->searchFeedback($fname,$lname,$start,$end);
    }
    $feedbacklist ="active";
    include  "header.php";
?>
<link rel="stylesheet" href="css/header.css" >
<!-- Start Feature Section -->
        <section id="feature" class="feature-section first-section">
            <div class="container">
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-12">
                        <form method="post">
                            <div class='col-md-2'>
                                <input type='text' class="form-control" placeholder="Professor First Name" name="fname">
                            </div>
                            <div class='col-md-2'>
                                <input type='text' class="form-control" placeholder="Professor Last Name" name="lname">
                            </div>
                            <div class='col-md-2'>
                                <input type='text' class="form-control date datepicker" placeholder="Start Date" name="start" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                            </div>
                            <div class='col-md-2'>
                                <input type='text' class="form-control date datepicker" placeholder="End Date" name="end" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                            </div>
                            <div class='col-md-2'>
                                <button type="submit" name="search" class="btn btn-primary"><strong><span class="fa fa-search"></span> &nbsp;&nbsp;Search</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome-section">
                                <h4 class="text-center">Feedback </h4> 
                                <div class="border"></div>
                                <br/>
                                <?php Session::getMessage(); ?>
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                           <th>Sr. NO.</th>
                                            <th>Student Name</th>
                                            <th>Professor Name</th>
                                            <th>Grade</th>
                                            <th>Feedback</th>
                                            <th>View More</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sr. NO.</th>
                                            <th>Student Name</th>
                                            <th>Professor Name</th>
                                            <th>Grade</th>
                                            <th>Feedback</th>
                                            <th>View More</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if($result->num_rows > 0) {
                                                $count=1;
                                                while ($row = $result->fetch_assoc()) {
                                                    $user = new Users();
                                                    $user->setId($row['user_student_id']);
                                                    $userResult = $user->getUserById();
                                                    $userrow = $userResult->fetch_assoc();
                                            ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $userrow['fname']." ".$userrow['lname']; ?></td>
                                            <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                            <td><?php echo $row['grade']; ?></td>
                                            <td><?php echo substr($row['msg'], 0, 40); ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-xs" href="viewadminfeedback.php?id=<?php echo $row['id']; ?>">
                                                    View More
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-xs" href="deletefeedback.php?id=<?php echo $row['id']; ?>">
                                                    <span class="fa fa-trash"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                                $count++;
                                                    }
                                            } ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12"></div>
                </div><!-- /.row -->
            </div>
        </section>
<?php include "footer.php"; ?>