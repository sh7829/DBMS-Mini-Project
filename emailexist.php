<?php
if(isset($_POST['email'])){
        include_once "classes/Users.php";
        $user = new Users();
        $user->setEmail($_POST['email']);
        $result = $user->checkEmail();
        $row = $result->fetch_assoc();
        echo $row['count'];
}
                                    

