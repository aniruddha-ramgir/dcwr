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
    <!-- / College Timetable -->
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
  <table  border='0' cellpadding='0' cellspacing='0'>
    <tr class='time'>
      <th></th>
      <th>1st Hour</th>
	  <th>2nd Hour</th>
	  <th>3rd Hour</th>
	  <th>4th Hour</th>
	  <th>5th Hour</th>
	  <th>6th Hour</th>
	  <th>7th Hour</th>
	  <th>8th Hour</th>
    </tr>
    <tr>
      <td class='days'>Monday</td>
      <td contenteditable='true' class='text blue' data-tooltip='Software Engineering &amp; Software Process'>CS335 [JH1]</td>
      <td contenteditable='true' class='text purple' data-tooltip='Computer Graphics'>CS426 [CS1]</td>
	  <td></td>
      <td></td>
	  <td></td>
      <td></td>
	  <td></td>
      <td>-</td>
    </tr>
    <tr>
      <td class='days'>Tuesday</td>
      <td></td>
      <td contenteditable='true' class='text blue lab' data-tooltip='Software Engineering &amp; Software Process'>CS335 [Lab]</td>
      <td contenteditable='true' class='text green' data-tooltip='Multimedia Production &amp; Management'>MD352 [Kairos]</td>
      <td contenteditable='true' ></td>
	  <td></td>
      <td></td>
	  <td></td>
      <td>-</td>
    </tr>
    <tr>
      <td class='days'>Wednesday</td>
      <td></td>
      <td class='text blue lab' data-tooltip='Software Engineering &amp; Software Process'>CS335 [Lab]</td>
      <td class='text green' data-tooltip='Multimedia Production &amp; Management'>MD352 [Kairos]</td>
      <td class='text orange' data-tooltip='Operating Systems'>CS240 [CH]</td>
	  <td></td>
      <td></td>
	  <td></td>
      <td>-</td>
    </tr>
    <tr>
      <td class='days'>Thursday</td>
      <td></td>
      <td class='text navy' data-tooltip='Media &amp; Globalisation'>MD303 [CS2]</td>
      <td class='text red' data-tooltip='Special Topic: Multiculturalism &amp; Nationalism'>MD313 [Iontas]</td>
      <td></td>
	  <td></td>
      <td></td>
	  <td></td>
      <td>-</td>
    </tr>
    <tr>
      <td class='days'>Friday</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
	  <td></td>
      <td></td>
	  <td></td>
      <td>-</td>
    </tr>
    <tr>
      <td class='days'>Saturday</td>
      <td></td>
      <td></td>
      <td class='text purple' data-tooltip='Computer Graphics'>CS426 [CS2]</td>
      <td class='text orange' data-tooltip='Operating Systems'>CS240 [TH1]</td>
      <td>-</td>
	  <td></td>
      <td></td>
	  <td></td>
    </tr>
  </table>
</div>
 <div>
	<table class='options' border='0' cellpadding='5' cellspacing='0'>
		<tr class='time'>
			<th></th>
			<th>Initial Date</th>
			<th>DCWR</th>
			<th>LESSON PLAN</th>
			<th></th>
			<th></th>
			<th>SUBMIT</th>
		</tr>
		<tr>
			<td class='days'></td>
			<td class='text'><input type="date" style="font-size: 1.3rem" name="start_date" min="2016-06-02" max="2016-12-20"></td> 
			<td class="text green" ><a href="#" >UPDATE</a></td>
			<td class="text purple" ><a href="#" >VIEW</a></td>
			<td></td>
			<td></td>
			<td class="text green" ><a href="#" >SUBMIT</a></td>
		</tr>
	</table>
  </div>
 </body>
</html>
