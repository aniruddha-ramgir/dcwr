<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	unset($_SESSION['logged_in']);  
	session_unset();
	session_destroy();
	header("Location: login.php");
	die();
?>