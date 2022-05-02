<?php
class Cookie{
	static function set($key,$value,$time){
		setcookie($key,$value,time()+$time);
	}

	static function get($key){
		if(isset($_COOKIE[$key])){
			return $_COOKIE[$key];
		}else{
			return false;
		}
	}

	static function display(){
		echo "<pre>";
			print_r($_COOKIE);
		echo "</pre>";
	}

	static function destroy($key,$time){
		setcookie($key,'',time()-$time);
	}

}