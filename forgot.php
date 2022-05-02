<?php 
 include_once 'classes/Session.php';
 Session::start();
if(isset($_POST['email'])){ 
        include_once "classes/Users.php";
        $user = new Users();
        $user->setEmail($_POST['email']);
        $user->setQuestion($_POST['question']);
        $user->setAnswer($_POST['answer']);
        $user->forgotPassword();
}
include  "header.php"  ?>
<link rel="stylesheet" href="css/header.css" >
<!-- Start Feature Section -->
        <section id="feature" class="feature-section first-section bg-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="welcome-section login-div">
                                <h4 class="text-center"> Recover Password </h4> 
                                <div class="border"></div>
                                <br/>
                                <?php Session::getMessage(); ?>
                                <form name="forgot" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email" name="email" data-validate="required,emailAddress">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="question" data-validate="required">
                                            <option value="">-- Select Question --</option>
                                            <option value='1'>Name of Your first school</option>
                                            <option value='2'>Name of your favourite restaurent</option>
                                            <option value='3'>Name of your favourite actor</option>
                                            <option value='4'>Your favourite movie</option>
                                            <option value='5'>Name of person you admire</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Answer" name="answer" data-validate="required">
                                    </div>
                                    <div class="form-group">
                                            <button name="login" value="login" class="btn btn-primary"> 
                                                <strong> Get Password </strong>
                                            </button>
                                    </div>
                                </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        
                    </div>
                </div><!-- /.row -->
            </div>
        </section>
<?php include "footer.php"; ?>