<?php
	include("connection.php");			//Give colours based on REASONS table
	include("logged_in.php");
	$id=$_SESSION['user_id'];
	$result = $conn->query('SELECT * FROM login where user_id = '. $_SESSION['user_id']. ' ');
	if(!empty($row = $result->fetch_assoc())){
		$name = $row['name'];
		$result = $conn->query('SELECT * FROM sections WHERE section_id=' . $_SESSION['section_id'] . ' ');
		if(!empty($row = $result->fetch_assoc())){
			$section = $row['name'];
		}
		$result = $conn->query('SELECT * FROM departments WHERE dept_id=' . $_SESSION['dept_id'] . ' ');
		if(!empty($row = $result->fetch_assoc())){
			$dept = $row['name'];
		}
		$result = $conn->query(' SELECT * FROM login WHERE user_id = (SELECT mentor_id FROM reports WHERE dcwr_id=' . $_SESSION['dcwr_id'] . ')');
		if(!empty($row = $result->fetch_assoc())){
			$reports = $row['name'];
		}
		$result = $conn->query(' SELECT * FROM login WHERE user_id = (SELECT admin_id FROM plans WHERE plan_id=' . $_SESSION['plan_id'] . ')');
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
<form role = form method="post" action="home.php">
	<input type="submit" id="submit-form" name="sign-form" style="display:none;" >
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
			<?php
					if(isset($_GET['start_date'])){							 //Checks for Manually selected date
						$startDate	   			= new DateTime($_GET['start_date']);		 
						$refDate  	  		    = new DateTime($_GET['start_date']);	//we are creating another object here instead of just making refDate a reference of startDate
						$_SESSION['start_date']  = $_GET['start_date'];
					}
					else if(isset($_SESSION['start_date'])){	 				//This code is executed if the SUBMIT button is not clicked AND the date is UPDATEd.
						$startDate	 =  new DateTime($_SESSION['start_date']); 	//This "else if" part is to make sure that the selected dates are UPDATEd.
						$refDate   	 =  new DateTime($_SESSION['start_date']);
						unset($_SESSION['start_date']);
					}
					else{
						$startDate 	= new DateTime('-7 days'); 	//default --- begins at -7 days
						$refDate    =  new DateTime('-7 days');
					}
					if(isset($_POST['sign-form'])){ 							//If SUBMIT is clicked.
						$count=0;
						$ErrorCount=0;
						while($count < 6){
							$refDateString = $refDate->format('Y-m-d');
							$sql1 = $conn->query(" SELECT dcwr_id FROM `reports_topic_data` WHERE date = '" . $refDateString . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
							$sql2 = $conn->query(" SELECT dcwr_id FROM `reports_subject_data` WHERE date = '" . $refDateString . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
							if( !empty($sql1->fetch_assoc() ) && !empty($sql2->fetch_assoc() ) ){
								$result = $conn->query('SELECT type_id FROM login where user_id = '. $_SESSION['user_id']. ' ');
								if(!empty($row = $result->fetch_assoc())){
									if($row['type_id']=="F"){
										$conn->query(" UPDATE `reports_topic_data` SET `Incharge` = '1' WHERE `reports_topic_data`.`dcwr_id` = " . $_SESSION['dcwr_id'] . " AND `reports_topic_data`.`date` = '" . $refDateString . "' ");
										//echo "<script type='text/javascript'>alert('Updated ". $refDateString ."')</script>";
									}
									else if($row['type_id']=="A"){
										$conn->query(" UPDATE `reports_topic_data` SET `Admin` = '1' WHERE `reports_topic_data`.`dcwr_id` = " . $_SESSION['dcwr_id'] . " AND `reports_topic_data`.`date` = '" . $refDateString . "' ");
									}
								}
							}
							else if($ErrorCount<2){ //Tries to fetch twice. Enters "IF" only if the number of failures is less that 2 (0 and 1)
								//echo "<script type='text/javascript'>alert('Date ". $refDateString ." Error Count.')</script>";
								$refDate = $refDate->add(new DateInterval('P1D'));
								$ErrorCount++;
								continue;
							}
							else{
								//echo "<script type='text/javascript'>alert('LoopHOLE2 ".$refDateString."')</script>";
								break;
							}
							$count++;
							$refDate = $refDate->add(new DateInterval('P1D'));
						}
						unset($_POST['submit-form']);
					}
				$count=0;
				$ErrorCount=0;
				while($count < 6){
					$dateString = $startDate->format('Y-m-d');
					$sql1 = $conn->query(" SELECT * FROM `reports_topic_data` WHERE date = '" . $dateString . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
					$sql2 = $conn->query(" SELECT * FROM `reports_subject_data` WHERE date = '" . $dateString . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
					if( !empty( $row1 = $sql1->fetch_assoc() ) && !empty( $row2 = $sql2->fetch_assoc() ) ){
						echo "<tr>";
						echo "<td class='days ' >".$startDate->format('Y-m-d'). "</td>";
						for($i=1;$i<9;$i++){
							$j="$i";
							$j.="H";
							$sql3 = $conn->query(" SELECT * FROM `reasons` WHERE date = '" . $dateString . "' and (dcwr_id = " . $_SESSION['dcwr_id'] . " and hour =" .$i. ") ");
							if( !empty( $row3 = $sql3->fetch_assoc() ) ){
								switch ($row3['event']) { //code for COLOURING cells
									case "On Track":
										echo "<td class='info ' data-tooltip=' ".($row2[$j])." '>".($row1[$j])."</td>";
										break;
									case "Substituted":
										echo "<td class='info yellow' data-tooltip=' ".($row2[$j])." '>".($row1[$j])."</td>";
										break;
									case "Delayed":
										echo "<td class='info orange' data-tooltip=' ".($row2[$j])." '>".($row1[$j])."</td>";
										break;
									case "Cancelled":
										echo "<td class='info red' data-tooltip=' ".($row2[$j])." '>".($row1[$j])."</td>";
										break;
									default: //useless but satefy feature.
										echo "<td class='info ' data-tooltip=' ".($row2[$j])." '>".($row1[$j])."</td>";	
								}
							}									
							else{ //in case reason does not exist
								echo "<td class='info ' data-tooltip=' ".($row2[$j])." '>".($row1[$j])."</td>";
							}
						}
						echo "</tr>";
					}
					else if($ErrorCount<2){ //Tries to fetch twice. Enters "IF" only if the number of failures is less that 2 (0 and 1)
						$startDate = $startDate->add(new DateInterval('P1D'));
						$ErrorCount++;
						continue;
					}
					else{
							echo "<script type='text/javascript'>alert('Unable to fetch complete report. (Holidays/Missing data)')</script>";
							break;
						}
					$count++;
					$startDate = $startDate->add(new DateInterval('P1D'));
				}
			?>
		</table>
	</div>
</form>
<form role = form method="get" action="home.php">
 <div>
	<table class='options' border='0' cellpadding='5' cellspacing='0'>
		<tr class='time'>
			<th></th>
			<th>Select Date</th>
			<th>DCWR</th>
		<!--	<th>ANALYSIS</th> -->
			<th>LESSON PLAN</th>
			<th>SCHEDULE</th>
			<th>SUBMIT</th>
		</tr>
		<tr>
			<td class='days'></td>
			<td class='text'><input type="date" style="font-size: 1.3rem" name="start_date" min="2016-06-02" max="2016-12-20"></td> 
			<td class="text green" ><input type="submit" value="UPDATE" class="button2 text green " name="update" ></td> 	<!-- uses GET to attach date to URL -->
		<!--	<td class="text purple" ><a href="analysis.html" >VIEW</a></td> -->
			<td class="text orange" ><a href="plan.php" >VIEW</a></td>
			<td class="text purple" ><a href="schedule.php" >VIEW</a></td>
			<td class="text green" ><label for="submit-form" class="button2 text green " >SUBMIT</label></td>
		</tr>
	</table>
  </div>
 </form>
 </body>
</html>