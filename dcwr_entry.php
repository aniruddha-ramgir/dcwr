<?php
	include("connection.php");
	$id=$_SESSION['user_id'];
	$login  = 'SELECT * FROM login where user_id = '. $_SESSION['user_id']. ' ';
	$result = $conn->query($login);
	if(!empty($row = $result->fetch_assoc())){
		$name = $row['name'];
		$section = 'SELECT * FROM sections WHERE section_id=' . $_SESSION['section_id'] . ' ';
		$dept = 'SELECT * FROM departments WHERE dept_id=' . $_SESSION['dept_id'] . ' ';
		$reports = ' SELECT * FROM login WHERE user_id = (SELECT mentor_id FROM reports WHERE dcwr_id=' . $_SESSION['dcwr_id'] . ')';
		$plans 	= ' SELECT * FROM login WHERE user_id = (SELECT admin_id FROM plans WHERE plan_id=' . $_SESSION['plan_id'] . ')';
		$result = $conn->query($section);
		if(!empty($row = $result->fetch_assoc())){
			$section = $row['name'];
		}
		$result = $conn->query($dept);
		if(!empty($row = $result->fetch_assoc())){
			$dept = $row['name'];
		}
		$result = $conn->query($reports);
		if(!empty($row = $result->fetch_assoc())){
			$reports = $row['name'];
		}
		$result = $conn->query($plans);
		if(!empty($row = $result->fetch_assoc())){
			$plans = $row['name'];
		}
	}
?> 
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Daily Class Work Report</title>
        <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
    <!-- / eDCWR -->
<div>
	<table border='0' cellpadding='0' cellspacing='0'>
		<tr class='time'>
			<th></th>
			<th>Name</th>
			<th>Unique ID</th>
			<th>Department</th>
			<th>Section</th>
			<th>Class Incharge</th>
			<th>Academic Incharge</th>
			<th></th>
		</tr>
		<tr>
			<td class='days'>Profile</td>
			<td class='info ' data-tooltip='your name'><?php echo $name; ?></td> 
			<td class='info' data-tooltip='your uniqueID'><?php echo $id; ?></td>
			<td class='info' data-tooltip='your department name'><?php echo $dept; ?></td>
			<td class='info' data-tooltip='your section name'><?php echo $section; ?></td>
			<td class='info' data-tooltip='your section name'><?php echo $reports; ?></td>
			<td class='info' data-tooltip='your section name'><?php echo $plans; ?></td>
			<td class="text red"><a href="logout.php" >LOG OUT</a></td>
		</tr>
	</table>
  </div>	
 <div class='tab'>
  <table  align="center" class='options' border='0' cellpadding='0' cellspacing='0'>
    <tr class='time'>
      <th>Date</th>
      <th>Hour</th>
	  <th>Event</th>
	  <th>Subject</th>
	  <th>Topic</th>
	  <th>SUBMIT</th>
    </tr>
	 <!-- Display rows for 8 hours. -->
		<td class='text'><input type="date" style="font-size: 1.3rem" name="start_date" min="2016-06-02" max="2016-12-20"></td> 
		<th><div class="dropdown">
			<button class="dropbtn green">Dropdown</button>
				<div class="dropdown-content">
				<a href="#">Hour 1</a> <!-- DESC then, print ROW[1H],ROW[2] and so on -->
				<a href="#">Hour 2</a>
				<a href="#">Hour 3</a>
				<a href="#">Hour 4</a>
				<a href="#">Hour 5</a>
				<a href="#">Hour 6</a>
				<a href="#">Hour 7</a>
				<a href="#">Hour 8</a>
				</div>
			</div>
		</th>
		<th class='text'>Event</th>
		<th class='text'>Subject</th>
		<th class='text'>Topic</th>
		<td class="text red"><a href="#" >SUBMIT</a></td>
	</table>
</div>