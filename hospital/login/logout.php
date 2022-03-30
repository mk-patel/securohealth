<?php
session_start();
session_destroy();
if(isset($_COOKIE["mobile_number"])){
	setcookie ("mobile_number","");
}
if(isset($_COOKIE["password"])){
	setcookie ("password","");
}
header('location:signin.php');
?>
