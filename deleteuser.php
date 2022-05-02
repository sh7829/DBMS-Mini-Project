<?php
include_once 'classes/Session.php';
Session::start();
if(!isset($_SESSION['id']) && Session::get('role') != 'Admin'){
        exit();
    }
include_once 'classes/Users.php';
$user = new Users();
$user->setId($_GET['id']);
$user->deleteUser();
header("Location:userlist.php");