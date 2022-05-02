<?php
include_once 'classes/Session.php';
Session::start();
if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
include_once 'classes/Professors.php';
$professor = new Professors();
$professor->setId($_GET['id']);
$professor->deleteProfessor();
header("Location:professorlist.php");