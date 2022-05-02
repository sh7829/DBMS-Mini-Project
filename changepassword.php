<?php 
 include_once 'classes/Session.php';
    Session::start();
    if(!isset($_SESSION['id'])){
        exit();
    }
if(isset($_POST['email'])){ 
    include_once "classes/Users.php";
    $user = new Users();
    $user->setPassword($_POST['password']);
    $user->setId(Session::get('id'));
    if($user->updatePassword()){
            $type = "success";
            $msg = "<strong>Success ! </strong> Password Changed ";
            Session::setMessage($type, $msg);
        }else{
            $type = "danger";
            $msg = "<strong>Error !</strong> Unable to change the password !";
            Session::setMessage($type, $msg);
        }
}
include  "header.php"  ?>
<link rel="stylesheet" href="css/header.css" >
<!-- Start Feature Section -->
        <section id="feature" class="feature-section first-section bg-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="welcome-section login-div">
                                <h4 class="text-center"> Change Password </h4> 
                                <div class="border"></div>
                                <br/>
                                    <?php Session::getMessage(); ?>
                                <form name="change" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo  Session::get('email'); ?>" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id="passwords" data-validate="required" placeholder="New Password *">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" data-validate="required,confirmPassword" placeholder="Confirm Password *">
                                    </div>
                                    <div class="form-group">
                                            <button name="login" value="login" class="btn btn-primary"> 
                                                <strong> Change </strong>
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