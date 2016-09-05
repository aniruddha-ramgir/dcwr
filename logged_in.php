<?php  				//This allows the pages to be viewed only if the user is logged in.
      if(!isset($_SESSION['logged_in'])){ 
		session_destroy();
		echo "<script type='text/javascript'>alert('Sorry! Login in again.')</script>";
		header("Location: login.php"); 
		die();
	  }
?>