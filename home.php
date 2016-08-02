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
	  <th>INCLUDE</th>
    </tr>
    <?php
		//$index= " SELECT * FROM `" . $_SESSION['dcwr_id'] . "` WHERE date = '" . date("Y-m-d") . "' ";  //get current date and nearest monday . And find its index.
		$startDate = new DateTime('-5 days');
			$i=1;
			$count=0;
			while($count < 7){
				//$sql = " SELECT * FROM `" . $_SESSION['dcwr_id'] . "` WHERE `index` = '" . $i . "' ";
				$dateString = $startDate->format('Y-m-d');
				$sql1 = $conn->query(" SELECT * FROM `reports_topic_data` WHERE date = '" . $dateString . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
				$sql2 = $conn->query(" SELECT * FROM `reports_subject_data` WHERE date = '" . $dateString . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
			if( !empty( $row1 = $sql1->fetch_assoc() ) | !empty( $row2 = $sql2->fetch_assoc() ) ){
						echo "<tr>";
						if( !($row1['CR']==0) ){
							echo "<td class='days'>".$startDate->format("D"). "</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['1H'])." '>".($row1['1H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['2H'])." '>".($row1['2H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['3H'])." '>".($row1['3H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['4H'])." '>".($row1['4H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['5H'])." '>".($row1['5H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['6H'])." '>".($row1['6H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['7H'])." '>".($row1['7H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['8H'])." '>".($row1['8H'])."</td>";
							echo '<td class="text" ><div class="onoffswitch">
								<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch'.$i.'">
								<label class="onoffswitch-label" for="switch'.$i.'">
								<span class="onoffswitch-inner"></span>
								<span class="onoffswitch-switch"></span>
								</label>
								</div></td>';
						}
						else{
							echo "<td class='days'>".$startDate->format('Y-m-d'). "</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['1H'])." '>".($row1['1H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['2H'])." '>".($row1['2H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['3H'])." '>".($row1['3H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['4H'])." '>".($row1['4H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['5H'])." '>".($row1['5H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['6H'])." '>".($row1['6H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['7H'])." '>".($row1['7H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['8H'])." '>".($row1['8H'])."</td>";
							echo '<td class="text" ><div class="onoffswitch">
								<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch'.$i.'">
								<label class="onoffswitch-label" for="switch'.$i.'">
								<span class="onoffswitch-inner"></span>
								<span class="onoffswitch-switch"></span>
								</label>
								</div></td>';
						}	
					echo "</tr>";
					$i=$i+1;
					}
					else{
						echo "<script type='text/javascript'>alert('". $dateString ." does not exist in the database.')</script>";
						break;
					}
				$count++;
				$startDate = $startDate->add(new DateInterval('P1D'));
				$dateString = $startDate->format('Y-m-d');
				
			}
		//}
		//else{
			//echo "<script type='text/javascript'>alert('Date does not exist in the database.')</script>";
		//}
	?>
  </table>
</div>
 <div>
	<table class='options' border='0' cellpadding='5' cellspacing='0'>
		<tr class='time'>
			<th></th>
			<th>Initial Date</th>
			<th>DCWR</th>
			<th>GRAPH</th>
			<th>LESSON PLAN</th>
			<th>SCHEDULE</th>
			<th>SUBMIT</th>
		</tr>
		<tr>
			<td class='days'></td>
			<td class='text'><input type="date" style="font-size: 1.3rem" name="start_date" min="2016-06-02" max="2016-12-20"></td> 
			<td class="text green" ><a href="#" >UPDATE</a></td>
			<td class="text purple" ><a href="#" >VIEW</a></td>
			<td class="text orange" ><a href="plan.php" >VIEW</a></td>
			<td class="text purple" ><a href="schedule.php" >VIEW</a></td>
			<td class="text green" ><a href="#" >SUBMIT</a></td>
		</tr>
	</table>
  </div>
 </body>
</html>
