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
		<td class='text'><input class="select-style" type="date" style=" font-size: 1.3rem" name="start_date" min="2016-06-02" max="2016-12-20"></td> 
		<th>
			<select class="select-style" name="hour">
				<option value="1H">Hour 1</option>
				<option value="2H">Hour 2</option>
				<option value="3H">Hour 3</option>
				<option value="4H">Hour 4</option>
				<option value="5H">Hour 5</option>
				<option value="6H">Hour 6</option>
				<option value="7H">Hour 7</option>
				<option value="8H">Hour 8</option>
			</select>
		</th>
		<th class='text'>  <!-- Event. -->
			<select class="select-style" name="event">
				<option value="E1">On track</option>
				<option value="E2">Subsituted</option>
				<option value="E3">Delayed</option>
			</select>
		</th>
	 	
		<?php
				$sql = $conn->query(" SELECT * FROM `subject_list` WHERE plan_id = " . $_SESSION['plan_id'] . " "); //GET ALL
					if( !empty( $row1 = $sql->fetch_assoc() ) ){
						echo "<th class='text' >"; 
							echo '<select class="select-style" name="event">';
								for($count=1;$count<10;$count++){ //Go through all subjects
									if(($sub = $row1['SUBJECT'.$count.''])!=NULL){  //display only if its not NULL
									echo '<option value="S' .$count.'">' . ($sub) . '</option>'; //$row1['SUBJECT'. $count . '']
									}
								}
							echo "</select>";
					echo "</th>";
					}
		?>
		<th class='text' contenteditable='true'></th>
		<td class="text green"><a href="#" >SUBMIT</a></td>
	</table>
</div>