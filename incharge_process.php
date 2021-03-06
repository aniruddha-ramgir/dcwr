<?php
	include("connection.php");
	include("logged_in.php");
	$_SESSION['year']=0; //get max
	$_SESSION['semester']=0; //get max in max
	$result = $conn->query('SELECT * FROM incharges WHERE user_id="' . $_SESSION['user_id'] . '"');
	if(!empty($row = $result->fetch_assoc())){
		$_SESSION['section_id']=$row['section_id'];
		//echo $_SESSION['section_id'];
	}
	$result = $conn->query('SELECT * FROM sections WHERE section_id =' . $_SESSION['section_id'] . ' ');
	if(!empty($row = $result->fetch_assoc())){
		$_SESSION['dept_id']=$row['dept_id'];
		//echo $_SESSION['dept_id'];
	}
	$result = $conn->query('SELECT * FROM reports WHERE section_id= ' . $_SESSION['section_id'] . ' ORDER BY `year` DESC LIMIT 1 ');
	if(!empty($row = $result->fetch_assoc())){
		$_SESSION['year']=$row['year'];
		//echo $_SESSION['year'];
	}
	$result = $conn->query('SELECT * FROM reports WHERE section_id= ' . $_SESSION['section_id'] . ' AND year= ' . $_SESSION['year'] . ' ORDER BY `semester` DESC LIMIT 1 ');
	if(!empty($row = $result->fetch_assoc())){
		$_SESSION['semester']=$row['semester']; //verify with cr_id and/or mentor_id, if this fails, he cant access that particular dcwr
		//echo $_SESSION['semester'];
	}
	$result = $conn->query(' SELECT * FROM reports WHERE section_id=' . $_SESSION['section_id'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ');
	if(!empty($row = $result->fetch_assoc())){
		$_SESSION['dcwr_id'] = $row['dcwr_id'];
		//echo $_SESSION['dcwr_id'];
	}
	if($row['mentor_id']== $_SESSION['user_id'] || $row['cr_id']== $_SESSION['user_id']){ //This is to differentiate between ex-Incharges and current incharges
		$result = $conn->query(' SELECT * FROM plans WHERE dept_id=' . $_SESSION['dept_id'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ');
		if(!empty($row = $result->fetch_assoc())){
			$_SESSION['plan_id'] = $row['plan_id'];
			//echo $_SESSION['plan_id'];
		}
		$result= $conn->query("SELECT type_id FROM login where user_id = '" .$_SESSION['user_id']."' ");
		if(!empty($row = $result->fetch_assoc())){
			if($row['type_id'] == 'C'){
				header('Location: dcwr_entry.php');
				exit();
			}
			else{
				header('Location: home.php');
				exit();
			}
		} 	
	}
	else{ //exit if they do not have access to current DCWR 
		session_unset();
		session_destroy(); 
		$conn->close();
		//echo "<script type='text/javascript'>alert('You are not allowed to access the current DCWR. Contact Admin')</script>";
		header('Location: login.php?loginFailed=AuthFailed'); 
		die();
	}
?>