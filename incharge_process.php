<?php
include("connection.php");
$_SESSION['year']=0; //get max
$_SESSION['semester']=0; //get max in max
$sections='SELECT * FROM incharges WHERE user_id="' . $_SESSION['user_id'] . '"';
$result = $conn->query($sections);
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['section_id']=$row['section_id'];
	//echo $_SESSION['section_id'];
}
$dept = 'SELECT * FROM sections WHERE section_id =' . $_SESSION['section_id'] . ' ';
$result = $conn->query($dept);
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['dept_id']=$row['dept_id'];
	//echo $_SESSION['dept_id'];
}
$year= 'SELECT * FROM reports WHERE section_id= ' . $_SESSION['section_id'] . ' ORDER BY `year` DESC LIMIT 1 ';
$result = $conn->query($year);
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['year']=$row['year'];
	//echo $_SESSION['year'];
}
$semester= 'SELECT * FROM reports WHERE section_id= ' . $_SESSION['section_id'] . ' AND year= ' . $_SESSION['year'] . ' ORDER BY `semester` DESC LIMIT 1 ';
$result = $conn->query($year);
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['semester']=$row['semester'];
	//echo $_SESSION['semester'];
}
$reports = ' SELECT * FROM reports WHERE section_id=' . $_SESSION['section_id'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ';
$result = $conn->query($reports);
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['dcwr_id'] = $row['dcwr_id'];
	//echo $_SESSION['dcwr_id'];
}
$plan 	= ' SELECT * FROM plans WHERE dept_id=' . $_SESSION['dept_id'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ';
$result = $conn->query($plan);
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['plan_id'] = $row['plan_id'];
	//echo $_SESSION['plan_id'];
}
$result= $conn->query("SELECT type_id FROM login where user_id = '" .$_SESSION['user_id']."' ");
if(!empty($row = $result->fetch_assoc())){
	if($row['type_id'] == 'C'){
		header('Location: dcwr_entry.php');
	}
	else{
		header('Location: home.php');
	}
}
?>