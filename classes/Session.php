<?php
class Session {
    static function start(){
        session_start();
    }
    static function set($key,$value){
        $_SESSION[$key] = $value;
    }
    static function get($key){
        if(isset($_SESSION[$key])){
           return $_SESSION[$key];
        }else{
            return false;
        }
    }
    static function reset(){
        session_unset();
    }
    static function destroy(){
        session_destroy();
    }
    static function display(){
        echo "<pre>";
            print_r($_SESSION);
        echo "</pre>";
    }
    
    static function setMessage($type,$msg){
        $_SESSION['message'] = "<div class='alert alert-$type'>".
                                                    "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".
                                                    " $msg ".
                                              "</div>";
    }
    
    static function getMessage(){
        if(isset($_SESSION['message']) && $_SESSION['message']!=""){
                echo $_SESSION['message'];
                $_SESSION['message'] ="";
        }
    }
    
}