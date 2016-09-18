<?php
	include("connection.php");			//Remember to add REASONS part.
	include("logged_in.php");
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
	function enterData()
	{
		include("connection.php"); 
		//echo "<script type='text/javascript'>alert('". $_POST["date"] ." ".$_POST["hour"]. " ".$_POST["event"]. " ".$_POST["subject"]. " ')</script>";
		$sql1 	= 	$conn->query(" SELECT * FROM `reports_topic_data` WHERE date = '" . $_POST["date"] . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
		$sql2 	= 	$conn->query(" SELECT * FROM `reports_subject_data` WHERE date = '" . $_POST["date"] . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
		if( !empty( $row1 = $sql1->fetch_assoc() ) | !empty( $row2 = $sql2->fetch_assoc() ) ){ //check if record already exists
			if( !($row1['Incharge']==0) ){ 		//check if Class Incharge has already signed
				echo "<script type='text/javascript'>alert('Record has already been approved by the Class Incharge. Cannot update now.')</script>";
			}
			else{
				$conn->query('UPDATE `reports_subject_data` SET `' .$_POST["hour"]. 'H` = "' .$_POST["subject"]. '" WHERE `reports_subject_data`.`dcwr_id` = ' . $_SESSION['dcwr_id'] . ' AND `reports_subject_data`.`date` = "' .  $_POST["date"] . '"'); //update subject
				$conn->query('UPDATE `reports_topic_data` SET `' .$_POST["hour"]. 'H` = "' .$_POST["topic"]. '" WHERE `reports_topic_data`.`dcwr_id` = ' . $_SESSION['dcwr_id'] . ' AND `reports_topic_data`.`date` = "' .  $_POST["date"] . '"');	//update topic
			}
		}
		else{ //create new record if it does not exist.
			$conn->query('INSERT INTO `reports_subject_data` (`dcwr_id`, `date`, `'.$_POST["hour"].'H`)  VALUES (' . $_SESSION['dcwr_id'] . ',"' .  $_POST["date"] . '","' .$_POST["subject"].'" )'); //Adding subjects
			$conn->query('INSERT INTO `reports_topic_data` (`dcwr_id`, `date`, `'.$_POST["hour"].'H`)  VALUES (' . $_SESSION['dcwr_id'] . ',"' .  $_POST["date"] . '","' .$_POST["topic"].'" )');	//Adding topics
		}
		$sql1 	= 	$conn->query(" SELECT * FROM `reasons` WHERE date = '" . $_POST["date"] . "' and (dcwr_id = " . $_SESSION['dcwr_id'] . " and hour =" .$_POST["hour"]. ") ");
		if( !empty( $row1 = $sql1->fetch_assoc() ) ){ //check if record already exists
			$conn->query('UPDATE `reasons` SET `event` = "' .$_POST["event"]. '" WHERE `reasons`.`dcwr_id` = ' . $_SESSION['dcwr_id'] . ' AND (`reasons`.`date` = "' .  $_POST["date"] . '" AND `reasons`.`hour` =' .$_POST["hour"]. ')');
			$conn->query('UPDATE `reasons` SET `reason` = "' .$_POST["reason"]. '" WHERE `reasons`.`dcwr_id` = ' . $_SESSION['dcwr_id'] . ' AND (`reasons`.`date` = "' .  $_POST["date"] . '" AND `reasons`.`hour` =' .$_POST["hour"]. ')');
		}
		else{ 	//create new record for REASON and EVENT if it does not exist.
			$conn->query('INSERT INTO `reasons` (`dcwr_id`, `date`, `hour`, `event`, `reason`)  VALUES (' . $_SESSION['dcwr_id'] . ',"' .  $_POST["date"] . '",' .$_POST["hour"].',"' .$_POST["event"].'","' .$_POST["reason"].'" )'); 
		}
		header('Location: dcwr_entry.php');
		exit();
	}
	if(isset($_POST['submit']))
	{
		enterData();
	} 
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>DCWR Entry</title>
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
  <form role = form method="post" action="dcwr_entry.php">
	<div class='tab'>
		<table  align="center" class='options' border='0' cellpadding='0' cellspacing='0'>
			<tr class='time'>
				<th>Date</th>
				<th>Hour</th>
				<th>Event</th>
				<th>Cause</th>
				<th>Subject</th>
				<th>Topic</th>
				<th>SUBMIT</th>
			</tr>
			<!-- Display rows for 8 hours. -->
	 
	
			<td class='text'><input class="select-style" type="date" style=" font-size: 1.3rem" name="date" min="2016-06-02" max="2016-12-20"></td> 
			<th>
				<select class="select-style" name="hour">
					<option value="1">Hour 1</option>
					<option value="2">Hour 2</option>
					<option value="3">Hour 3</option>
					<option value="4">Hour 4</option>
					<option value="5">Hour 5</option>
					<option value="6">Hour 6</option>
					<option value="7">Hour 7</option>
					<option value="8">Hour 8</option>
				</select>
			</th>
			<th class='text'>  <!-- Event. -->
				<select class="select-style" name="event">
					<option value="On Track">On track</option>
					<option value="Substituted">Subsituted</option>
					<option value="Delayed">Delayed</option>
					<option value="Cancelled">Cancelled</option>
				</select>
			</th>
			<th class='text'><input type="text" name="reason" placeholder="enter cause" class='textBox'></th>
			<?php 	//Extract subject list from Subject list table
					$sql = $conn->query(" SELECT * FROM `subject_list` WHERE plan_id = " . $_SESSION['plan_id'] . " "); //GET ALL
						if( !empty( $row1 = $sql->fetch_assoc() ) ){
							echo "<th class='text' >"; 
								echo '<select class="select-style" name="subject">';
									for($count=1;$count<10;$count++){ //Go through all subjects
										if(($sub = $row1['SUBJECT'.$count.''])!=NULL){  //display only if its not NULL
											echo '<option value="' .$sub. '">' . ($sub) . '</option>'; //$row1['SUBJECT'. $count . '']
										}
									}
									echo '<option value="NULL">NULL</option>'; //additional option to denote that no classes were conduncted
								echo "</select>";
						echo "</th>";
						}
			?>
			<th class='text'><input type="text" name="topic" placeholder="enter topic" class='textBox' required="required"></th>
			<td class="text green" ><input name="submit" value="SUBMIT" type="submit"  class="button1 text green " ></td>
		
		</table>
	</div>
</form>
<div>
	<table align="center" class='options' border='0' cellpadding='5' cellspacing='0'>
		<tr class='time'>
			<th>DCWR</th>
			<th>LESSON PLAN</th>
			<th>SCHEDULE</th>
		</tr>
		<tr>
			<td class="text purple" ><a href="dcwr.php" >VIEW</a></td>
			<td class="text orange" ><a href="plan.php" >VIEW</a></td>
			<td class="text purple" ><a href="schedule.php" >VIEW</a></td>
		</tr>
	</table>
  </div>