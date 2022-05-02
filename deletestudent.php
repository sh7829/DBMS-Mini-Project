<?php
include_once 'classes/Session.php';
Session::start();
if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
include_once 'classes/Students.php';
$student = new Students();
$student->setId($_GET['id']);
$student->deleteStudent();
header("Location:studentlist.php");