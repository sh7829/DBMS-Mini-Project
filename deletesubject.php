<?php
include_once 'classes/Session.php';
Session::start();
if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
include_once 'classes/Subjects.php';
$subject = new Subjects();
$subject->setId($_GET['id']);
$subject->deleteSubject();
header("Location:subjectlist.php");