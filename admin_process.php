<?php
include("connection.php");
$_SESSION['year']=$_POST['year'];
$_SESSION['semester']=$_POST['semester'];
$dept = 'SELECT * FROM admins WHERE user_id = ' . $_SESSION['user_id'] . ' ';
$result = $conn->query($dept);
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['dept_id']=$row['dept_id'];
	//echo $_SESSION['dept_id'];
}
$sections='SELECT * FROM sections WHERE name= "' . $_POST['section'] . '" AND dept_id= ' . $_SESSION['dept_id'] . ' ';
$result = $conn->query($sections);
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['section_id']=$row['section_id'];
	//echo $_SESSION['section_id'];
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
header('Location: home.php');
?>