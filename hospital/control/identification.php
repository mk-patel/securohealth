<?php
	// Starting the session to keep the user logged in.
	session_start();

	// This ("connetion.php") file contains Database Connection code.
	require_once '../../sys-control/connection.php';
	
	// Including cryptography codes.
	require_once "../../sys-components/crypt/pub-encrypt.php";
	require_once "../../sys-components/crypt/pub-decrypt.php";

	/**
	* Taking mobile number and hp_password from session.
	* Validating the user.
	*/
	$hp_id = aes_decrypt($_SESSION['hp_id']);
	$hp_email = aes_decrypt($_SESSION['hp_email']);
	$hp_password = aes_decrypt($_SESSION['hp_password']);
	
	if(empty($hp_id) || empty($hp_email) || empty($hp_password)){
		header("location: ../../index.php");
	}else{
			
		$query = "select hp_email,hp_password,hp_name,hp_status from hospital where hp_id='$hp_id' and hp_password='$hp_password'";
		$result = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($result)<=0){
			header('location: ../../index.php');
		}
		
		else{
			$row = mysqli_fetch_assoc($result);
			$hp_name = aes_decrypt($row["hp_name"]);
			$hp_email_dec = aes_decrypt($row["hp_email"]);
			$hp_status = $row["hp_status"];

			if(empty($hp_id) || empty($hp_email) || empty($hp_password)){
				header("location: ../../index.php");
			}
			else if($hp_status == 0){
				header("location: ../../issue.php?i=1");
			}
			else if($hp_email != $hp_email_dec){
				header("location: ../../index.php");
			}
			else if($hp_password != $row["hp_password"]){
				header("location: ../../index.php");
			}
		}
	}
?>