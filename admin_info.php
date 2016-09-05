<?php
	if(isset($_POST['create']))
	{
		create();
	}
	if(isset($_POST['view']))
	{
		view();
	}
	function view(){
		include("connection.php");
		include("logged_in.php");
		$_SESSION['year']=$_POST['year'];
		$_SESSION['semester']=$_POST['semester'];
		$result = $conn->query('SELECT * FROM admins WHERE user_id = ' . $_SESSION['user_id'] . ' ');
		if(!empty($row = $result->fetch_assoc())){ 
			$_SESSION['dept_id']=$row['dept_id'];
			//echo $_SESSION['dept_id'];
		}
		$result = $conn->query('SELECT * FROM sections WHERE batch= ' . $_POST['batch'] . ' AND (dept_id= ' . $_SESSION['dept_id'] . ' AND name= "' . $_POST['section']  . '" )');
		if(!empty($row = $result->fetch_assoc())){
			$_SESSION['section_id']=$row['section_id'];
			//echo $_SESSION['section_id'];
		}
		$result = $conn->query(' SELECT * FROM reports WHERE section_id=' . $_SESSION['section_id'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ');
		if(!empty($row = $result->fetch_assoc())){
			$_SESSION['dcwr_id'] = $row['dcwr_id'];
			//echo $_SESSION['dcwr_id'];
		}
		$result = $conn->query(' SELECT * FROM plans WHERE dept_id=' . $_SESSION['dept_id'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ');
		if(!empty($row = $result->fetch_assoc())){
			$_SESSION['plan_id'] = $row['plan_id'];
			//echo $_SESSION['plan_id'];
		}
		header('Location: home.php');
		exit();
	}
	function create(){
		include("connection.php");
		include("logged_in.php");
		$_SESSION['year']=$_POST['year'];
		$_SESSION['semester']=$_POST['semester'];
		$_SESSION['mentor']= $_POST['mentor'];
		//$dept = 'SELECT * FROM admins WHERE user_id = ' . $_SESSION['user_id'] . ' ';
		$result = $conn->query('SELECT * FROM admins WHERE user_id = ' . $_SESSION['user_id'] . ' '); //get dept_id 
		if(!empty($row = $result->fetch_assoc())){
			$_SESSION['dept_id']=$row['dept_id'];
			//echo $_SESSION['dept_id'];
		}
		//$sections='SELECT * FROM sections WHERE batch= "' . $_POST['batch'] . '" AND ( dept_id= ' . $_SESSION['dept_id'] . ' AND name= "' . $_POST['section']  . '" )';
		$result = $conn->query('SELECT * FROM sections WHERE batch= "' . $_POST['batch'] . '" AND ( dept_id= ' . $_SESSION['dept_id'] . ' AND name= "' . $_POST['section']  . '" )'); //get section_id 
		if(!empty($row = $result->fetch_assoc())){
			$_SESSION['section_id']=$row['section_id'];
			//echo $_SESSION['section_id'];
		}
		else{
			echo "Entered Section does not exist in your department";
		}
		$result = $conn->query('SELECT * FROM `incharges` WHERE user_id = ' . $_SESSION['mentor'] . ' '); //get Mentor details.
		if(!empty($row = $result->fetch_assoc())){ 
			if($_SESSION['mentor']==$row['user_id']){ //check if entered Mentor exists and only then, insert new dcwr row.
			$result = $conn->query('SELECT COUNT(*) AS SUM FROM `reports` WHERE section_id=' . $_SESSION['section_id'] . ' AND ( mentor_id = ' . $_SESSION['mentor'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ) ');
			if(!empty($row=$result->fetch_assoc())){ //Add to reports table only if the record does not exist //does not work. It will not enter the if statement, if the record does not exist
				if ($row['SUM'] >0 ){
					echo "<script type='text/javascript'>alert('Record already exists!.')</script>"; 
					break;
				}
				else{
					if ($conn->query('INSERT INTO `reports`(`section_id`, `year`, `semester`, `mentor_id`) VALUES ( ' . $_SESSION['section_id'] . ',' . $_SESSION['year'] . ',' . $_SESSION['semester'] . ',' . $_SESSION['mentor'] . ')') === TRUE){
						header('Location: admin_info.php'); //Redirect to itself after a successful Insertion
						exit();
					}
					else{
						echo "<script type='text/javascript'>alert('Could not assign DCWR_ID for the entered details.')</script>";
						return;
					} //Everything written below is to create empty records in the Database. I don't think it is necessary anymore. (because there was no dedicated dcwr entry page earlier.)
				
				/*	$reports = ' SELECT * FROM reports WHERE section_id=' . $_SESSION['section_id'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ';
					$result = $conn->query($reports); //get dcwr_id and create a table with that dcwr_id
					if($_SESSION['semester']==1){ //pick a date based on the semester. Either get those dates from admin or use fixed dates. June X to Dec Y - Sem 1, Jan X - April Y - Sem 2
						$startDate = new DateTime('2016-06-01'); //year should be dynamic.
					}
					else if($_SESSION['semester']==2){
						$startDate = new DateTime('2016-01-01');
					}
					else{
						echo "<script type='text/javascript'>alert('Invalid semester!')</script>";
					}
					if(!empty($row = $result->fetch_assoc())){  
						//echo $_SESSION['dcwr_id'];
						$count=0;
						while($count<33){ // number of days in a semester = 120
							$dateString = $startDate->format('Y-m-d');
							$create1 = 'INSERT INTO `reports_subject_data` (`dcwr_id`, `date`)  VALUES (' . $row['dcwr_id'] . ',"' . $dateString . '" )'; //Adding empty subjects
							$create2 = 'INSERT INTO `reports_topic_data` (`dcwr_id`, `date`)  VALUES (' . $row['dcwr_id'] . ',"' . $dateString . '" )';	//Adding empty topics
							if ($conn->query($create1) === TRUE & $conn->query($create2) === TRUE) { //check if its succesfully added then, increment count. Else, display error.
								$count++;
								$startDate = $startDate->add(new DateInterval('P1D'));
								header('Location: admin_info.php');
								exit();
							}
							else{
								echo "<script type='text/javascript'>alert('Could not add Empty Subject and/or topic record.')</script>";
								break;
							}
						}
						echo "<script type='text/javascript'>alert('Record created sucessfully')</script>";
					} */
				}
			}
		}
			else{
				echo 'Mentor ID does not exist';
			}
		}
	}
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>eDCWR</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
		<link rel="stylesheet" href="css/login.css">
</head>
<body>    
<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Additional Information Required</h1>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">DCWR Details</h1>
    <form role = form action="admin_info.php" method="post">
	<div class="input-container">
        <input type="text" name="batch" required="required"/>
        <label for="Username">Batch</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" name="year" required="required"/>
        <label for="Username">Year</label>
        <div class="bar"></div>
      </div>
	  <div class="input-container">
        <input type="text" name="semester" required="required"/>
        <label for="Username">Semester</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" name="section" required="required"/>
        <label for="Username">Section</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button type="submit" name="view" ><span>Submit</span></button>
      </div>
    </form>
  </div>
  <div class="card alt">
    <div class="toggle"></div>
    <h1 class="title">Register
      <div class="close"></div>
    </h1>
    <form role = form action="admin_info.php" method="post">
	<div class="input-container">
        <input type="text" name="batch" required="required"/>
        <label for="Username">Batch</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" name="year" required="required"/>
        <label for="Username">Year</label>
        <div class="bar"></div>
      </div>
	  <div class="input-container">
        <input type="text" name="semester" required="required"/>
        <label for="Username">Semester</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" name="section" required="required"/>
        <label for="Username">Section</label>
        <div class="bar"></div>
      </div>
	   <div class="input-container">
        <input type="text" name="mentor" required="required"/>
        <label for="Username">Mentor ID</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button type="submit" name="create" ><span>Submit</span></button>
      </div>
    </form>
  </div>
</div>
<script src='js/button.js'></script>
 <script src="js/index.js"></script>
  </body>
</html>
