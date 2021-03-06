<?php
	include("connection.php");
	include("logged_in.php");
?> 
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Lesson Plan</title>
        <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
    <!-- / plan -->	
<div class='tab'>
  <table  border='0' cellpadding='0' cellspacing='0'>
    <tr class='time'>
      <th></th>
      <th>SUBJECT 1</th>
	  <th>SUBJECT 2</th>
	  <th>SUBJECT 3</th>
	  <th>SUBJECT 4</th>
	  <th>SUBJECT 5</th>
	  <th>SUBJECT 6</th>
	  <th>SUBJECT 7</th>
	  <th>SUBJECT 8</th>
    </tr>
    <?php //try to GET date from URL, else do this. SUBMIT button will append date to url and redirect
		if(isset($_GET['date'])){
			$startDate = new DateTime($_GET['date']); //WORKS.
		}
		else{
			$startDate = new DateTime('-7 days'); //begins at -5 days
		}
		$count=0;
		$ErrorCount=0; 
		while($count < 6){
			$dateString = $startDate->format('Y-m-d'); //Dont forget to change reports to plans. 
			$sql1 = $conn->query(" SELECT * FROM `plans_topic_data` WHERE date = '" . $dateString . "' and plan_id = " . $_SESSION['plan_id'] . " ");
			$sql2 = $conn->query(" SELECT * FROM `plans_subject_data` WHERE date = '" . $dateString . "' and plan_id = " . $_SESSION['plan_id'] . " ");
				if( !empty( $row1 = $sql1->fetch_assoc() ) & !empty( $row2 = $sql2->fetch_assoc() ) ){
					echo "<tr>";
						echo "<td class='days ' >".$startDate->format('Y-m-d'). "</td>"; //add tooltips
						echo "<td class='info ' data-tooltip=' ".($row2['subject1'])." '>".($row1['subject1'])."</td>";
						echo "<td class='info ' data-tooltip=' ".($row2['subject2'])." '>".($row1['subject2'])."</td>";
						echo "<td class='info ' data-tooltip=' ".($row2['subject3'])." '>".($row1['subject3'])."</td>";
						echo "<td class='info ' data-tooltip=' ".($row2['subject4'])." '>".($row1['subject4'])."</td>";
						echo "<td class='info ' data-tooltip=' ".($row2['subject5'])." '>".($row1['subject5'])."</td>";
						echo "<td class='info ' data-tooltip=' ".($row2['subject6'])." '>".($row1['subject6'])."</td>";
						echo "<td class='info ' data-tooltip=' ".($row2['subject7'])." '>".($row1['subject7'])."</td>";
						echo "<td class='info ' data-tooltip=' ".($row2['subject8'])." '>".($row1['subject8'])."</td>";
				echo "</tr>";
				}
				else if($ErrorCount<1){
					//echo "<script type='text/javascript'>alert('Date ". $dateString ." does not exist in the database.')</script>";
					$startDate = $startDate->add(new DateInterval('P1D'));
					$ErrorCount++;
					continue;
				}
				else{
					echo "<script type='text/javascript'>alert('Some dates are unavailable.(Holidays/Missing data)')</script>";
					break;
				}
			$count++;
			$startDate = $startDate->add(new DateInterval('P1D'));
		}
	?>
  </table>
</div>
<form role = form method="get" action="plan.php">
 <div>
	<table class='options' border='0' cellpadding='5' cellspacing='0'>
		<tr class='time'>
			<th>Initial Date</th>
			<th>Plan</th>
			<th>e-DCWR</th>
		</tr>
		<tr>
			<td class='text'><input name="date" type="date" style=" font-size: 1.3rem" ></td> 
			<td class="text green" ><input type="submit" class="button2 text green " name="UPDATE" ></td> 
			<td class="text red" ><a href="javascript:history.go(-1)" >Go back</a></td> <!-- Goes back to actual previous page -->
		</tr>
	</table>
  </div>
 </form>
 </body>
</html>
