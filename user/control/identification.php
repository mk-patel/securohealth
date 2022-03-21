<?php
	// Starting the session to keep the user logged in.
	session_start();

	// This ("connetion.php") file contains Database Connection code.
	require_once '../../sys-control/connection.php';
	
	// Including cryptography codes.
	require_once "../../sys-components/crypt/pub-encrypt.php";
	require_once "../../sys-components/crypt/pub-decrypt.php";

	/**
	* Taking mobile number and password from session.
	* Validating the user.
	*/
	$user_id = aes_decrypt($_SESSION['uid']);
	$user_email = aes_decrypt($_SESSION['email']);
	$password = aes_decrypt($_SESSION['password']);
	
	if(empty($user_id) || empty($user_email) || empty($password)){
		header("location: ../../index.html");
	}else{
			
		$query = "select user_email,password,user_first_name,user_verified,user_status from user where user_id='$user_id' and password='$password'";
		$result = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($result)<=0){
			header('location: ../../index.html');
		}
		
		else{
			$row = mysqli_fetch_assoc($result);
			$user_first_name = aes_decrypt($row["user_first_name"]);
			$user_email_dec = aes_decrypt($row["user_email"]);
			$user_verified = $row['user_verified'];
			$user_status = $row["user_status"];

			if(empty($user_verified) || empty($user_status) || empty($user_first_name)){
				header("location: ../../index.html");
			}
			else if($user_verified != 1 || $user_status == 3){
				header("location: ../../index.html");
			}
			else if($user_email != $user_email_dec){
				header("location: ../../index.html");
			}
			else if($password != $row["password"]){
				header("location: ../../index.html");
			}
		}
	}
?>