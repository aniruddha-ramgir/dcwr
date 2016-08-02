<?php
include("connection.php");
$_SESSION['year']=$_POST['year'];
$_SESSION['semester']=$_POST['semester'];
$_SESSION['mentor']= $_POST['mentor'];
$dept = 'SELECT * FROM admins WHERE user_id = ' . $_SESSION['user_id'] . ' ';
$result = $conn->query($dept); //get dept_id 
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['dept_id']=$row['dept_id'];
	//echo $_SESSION['dept_id'];
}
$sections='SELECT * FROM sections WHERE name= "' . $_POST['section'] . '" AND dept_id= ' . $_SESSION['dept_id'] . ' ';
$result = $conn->query($sections); //get section_id 
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['section_id']=$row['section_id'];
	//echo $_SESSION['section_id'];
}
$mentor = 'SELECT * FROM `incharges` WHERE user_id = ' . $_SESSION['mentor'] . ' '; 
$result = $conn->query($mentor);
if(!empty($row = $result->fetch_assoc())){ 
	if($_SESSION['mentor']==$row['user_id']){ //check if entered Mentor exists and only then, insert new dcwr row.
		$insert = 'INSERT INTO `reports`(`section_id`, `year`, `semester`, `mentor_id`) VALUES ( ' . $_SESSION['section_id'] . ',' . $_SESSION['year'] . ',' . $_SESSION['semester'] . ',' . $_SESSION['mentor'] . ')';
		$result = $conn->query($insert);
		$reports = ' SELECT * FROM reports WHERE section_id=' . $_SESSION['section_id'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ';
		$result = $conn->query($reports); //get dcwr_id and create a table with that dcwr_id
		$startDate = new DateTime('2016-06-01'); //pick a date based on the semester.
		if(!empty($row = $result->fetch_assoc())){
			//echo $_SESSION['dcwr_id'];
			while(count<120){ // number of days in a semester
				$dateString = $startDate->format('Y-m-d');
				$create1 = 'INSERT INTO `reports_subject_data` (' . $row['dcwr_id'] . ',' . $dateString . ' 	)'; //COMPLETE THIS and make the code neater, efficient.
						//ADD empty rows. from Start date to end date. Either get those dates from admin or use fixed dates. June X to Dec Y - Sem 1, Jan X - April Y - Sem 2
				$create1 = 'INSERT INTO `reports_topics_data` (' . $row['dcwr_id'] . ',' . $dateString . ' 	)';
				//check if its succesfully added then, increment count. Else, display error.
				$count++;
				$startDate = $startDate->add(new DateInterval('P1D'));
				$dateString = $startDate->format('Y-m-d');
			}
		}
	}
	else{
		echo 'Mentor ID does not exist';
	}
}
?>