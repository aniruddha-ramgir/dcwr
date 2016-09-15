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
			if( !($row1['Incharge']==0) ){ //check if Incharge has signed
				echo "<script type='text/javascript'>alert('Record has already been approved by the Class Incharge. Cannot update now.')</script>";
				header('Location: dcwr_entry.php');
				exit();
			}
			else{
				$update1	=	$conn->query('UPDATE `reports_subject_data` SET `' .$_POST["hour"]. '` = "' .$_POST["subject"]. '" WHERE `reports_subject_data`.`dcwr_id` = ' . $_SESSION['dcwr_id'] . ' AND `reports_subject_data`.`date` = "' .  $_POST["date"] . '"'); //update subject
				$update2	=	$conn->query('UPDATE `reports_topic_data` SET `' .$_POST["hour"]. '` = "' .$_POST["topic"]. '" WHERE `reports_topic_data`.`dcwr_id` = ' . $_SESSION['dcwr_id'] . ' AND `reports_topic_data`.`date` = "' .  $_POST["date"] . '"');	//update topic
				header('Location: dcwr_entry.php');
				exit();
			}
		}
		else{
			$create1 	= 	$conn->query('INSERT INTO `reports_subject_data` (`dcwr_id`, `date`, `'.$_POST["hour"].'`)  VALUES (' . $_SESSION['dcwr_id'] . ',"' .  $_POST["date"] . '","' .$_POST["subject"].'" )'); //Adding subjects
			$create2 	= 	$conn->query('INSERT INTO `reports_topic_data` (`dcwr_id`, `date`, `'.$_POST["hour"].'`)  VALUES (' . $_SESSION['dcwr_id'] . ',"' .  $_POST["date"] . '","' .$_POST["topic"].'" )');	//Adding topics
			header('Location: dcwr_entry.php');
			exit();
		}
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
				<th>Subject</th>
				<th>Topic</th>
				<th>SUBMIT</th>
			</tr>
			<!-- Display rows for 8 hours. -->
	 
	
			<td class='text'><input class="select-style" type="date" style=" font-size: 1.3rem" name="date" min="2016-06-02" max="2016-12-20"></td> 
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
					<option value="On Track">On track</option>
					<option value="Substituted">Subsituted</option>
					<option value="Delayed">Delayed</option>
				</select>
			</th>
	 	
			<?php //Extract subject list from Subject list table
					$sql = $conn->query(" SELECT * FROM `subject_list` WHERE plan_id = " . $_SESSION['plan_id'] . " "); //GET ALL
						if( !empty( $row1 = $sql->fetch_assoc() ) ){
							echo "<th class='text' >"; 
								echo '<select class="select-style" name="subject">';
									for($count=1;$count<10;$count++){ //Go through all subjects
										if(($sub = $row1['SUBJECT'.$count.''])!=NULL){  //display only if its not NULL
										echo '<option value="' .$sub. '">' . ($sub) . '</option>'; //$row1['SUBJECT'. $count . '']
										}
									}
								echo "</select>";
						echo "</th>";
						}
			?>
			<th class='text'><input type="text" name="topic"  class='textBox' required="required"></th>
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