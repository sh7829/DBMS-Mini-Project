<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php //echo $title ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
    
    <!-- Animate CSS -->
    <link href="css/animate.css" rel="stylesheet" >
    
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css" >
    <link rel="stylesheet" href="css/owl.theme.css" >
    <link rel="stylesheet" href="css/owl.transitions.css" >

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    
    <!-- Colors CSS -->
    <link rel="stylesheet" type="text/css" href="css/color/green.css">
    
    <!-- Colors CSS -->
    <link rel="stylesheet" type="text/css" href="css/color/green.css" title="green">
    <link rel="stylesheet" type="text/css" href="css/color/light-red.css" title="light-red">
    <link rel="stylesheet" type="text/css" href="css/color/blue.css" title="blue">
    <link rel="stylesheet" type="text/css" href="css/color/light-blue.css" title="light-blue">
    <link rel="stylesheet" type="text/css" href="css/color/yellow.css" title="yellow">
    <link rel="stylesheet" type="text/css" href="css/color/light-green.css" title="light-green">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" type="text/css" href="css/custom.css" >
    <link rel="stylesheet" href="css/datepicker.css">
    <!-- Modernizer js -->
    <script src="js/modernizr.custom.js"></script>

    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery Version 2.1.1 -->
    <script src="js/jquery-2.1.1.min.js"></script>
</head>

<body class="index">
    
    <!-- Styleswitcher
================================================== -->
        <div class="colors-switcher">
            <a id="show-panel" class="hide-panel"><i class="fa fa-tint"></i></a>        
                <ul class="colors-list">
                    <li><a title="Light Red" onClick="setActiveStyleSheet('light-red'); return false;" class="light-red"></a></li>
                    <li><a title="Blue" class="blue" onClick="setActiveStyleSheet('blue'); return false;"></a></li>
                    <li class="no-margin"><a title="Light Blue" onClick="setActiveStyleSheet('light-blue'); return false;" class="light-blue"></a></li>
                    <li><a title="Green" class="green" onClick="setActiveStyleSheet('green'); return false;"></a></li>
                    
                    <li class="no-margin"><a title="light-green" class="light-green" onClick="setActiveStyleSheet('light-green'); return false;"></a></li>
                    <li><a title="Yellow" class="yellow" onClick="setActiveStyleSheet('yellow'); return false;"></a></li>
                    
                </ul>

        </div>  
<!-- Styleswitcher End
================================================== -->

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <?php
                    if(isset($_SESSION['id'])){ ?>
                    <?php 
                        if($_SESSION['role'] == "Admin"){
                    ?>  
                        <li class="<?php echo $dashboard; ?>">
                            <a class="page-scroll " href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="<?php echo $userlist; ?>">
                            <a class="page-scroll " href="userlist.php">Users</a>
                        </li>
                        <li class="<?php echo $studentlist; ?>">
                            <a class="page-scroll " href="studentlist.php">Students</a>
                        </li>
                        <li class="<?php echo $professorlist; ?>">
                            <a class="page-scroll " href="professorlist.php">Professors</a>
                        </li>
                        <li class="<?php echo $subjectlist; ?>">
                            <a class="page-scroll " href="subjectlist.php">Subjects</a>
                        </li>
                        <li class="<?php echo $feedbacklist; ?>">
                            <a class="page-scroll " href="adminfeedback.php">Feedback</a>
                        </li>
                    <?php    
                        }
                        if($_SESSION['role'] == 'Student'){
                    ?>
                        <li class="<?php echo $profile." ".$show; ?>">
                            <a class="page-scroll " href="studentprofile.php">Profile</a>
                        </li>
                        <li class="<?php echo $feedbacklist." ".$show; ?>">
                            <a class="page-scroll " href="stud_prof_feedback.php">Feedback</a>
                        </li>
                     <?php }if($_SESSION['role'] == 'Professor'){ ?>
                        <li class="<?php echo $profile." ".$show; ?>">
                            <a class="page-scroll " href="professorprofile.php">Profile</a>
                        </li>
                        <li class="<?php echo $feedbacklist." ".$show; ?>">
                            <a class="page-scroll " href="stud_prof_feedback.php">Feedback</a>
                        </li>
                     <?php } ?>
                        <li>
                            <a class="page-scroll " href="logout.php">LogOut</a>
                        </li>
                     <?php }else{?>
                    <li class="<?php echo $login; ?>">
                        <a class="page-scroll " href="login.php">Login</a>
                    </li>
                    <li class="<?php echo $registration; ?>">
                        <a class="page-scroll" href="registration.php">Registration</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about-us">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#service">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Team</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>