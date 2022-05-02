<?php
include_once 'classes/Session.php';
Session::start();
if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
}
include_once 'classes/Feedbacks.php';
$feedback = new Feedbacks();
$feedback->setId($_GET['id']);
$feedback->deleteFeedback();
header("Location:adminfeedback.php");