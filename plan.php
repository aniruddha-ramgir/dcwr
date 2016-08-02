<?php
	include("connection.php");
?> 
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Daily Class Work Report</title>
        <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
    <!-- / plan -->	
<div class='tab'>
  <table  border='0' cellpadding='0' cellspacing='0'>
    <tr class='time'>
      <th></th>
      <th>SUBJECT 1</th>
	  <th>SUBJECT </th>
	  <th>SUBJECT </th>
	  <th>SUBJECT </th>
	  <th>SUBJECT </th>
	  <th>SUBJECT </th>
	  <th>SUBJECT </th>
	  <th>8SUBJECT </th>
    </tr>
    <?php
		$startDate = new DateTime('-5 days');
			$count=0;
			while($count < 7){
				$dateString = $startDate->format('Y-m-d');
				$sql = $conn->query(" SELECT * FROM `plans_topic_data` WHERE date = '" . $dateString . "' and plan_id = " . $_SESSION['plan_id'] . " ");
					if( !empty( $row1 = $sql->fetch_assoc() ) ){
						echo "<tr>";
							echo "<td class='days'>".$startDate->format("D"). "</td>";
							echo "<td>".($row1['subject1'])."</td>";
							echo "<td>".($row1['subject2'])."</td>";
							echo "<td>".($row1['subject3'])."</td>";
							echo "<td>".($row1['subject4'])."</td>";
							echo "<td>".($row1['subject5'])."</td>";
							echo "<td>".($row1['subject6'])."</td>";
							echo "<td>".($row1['subject7'])."</td>";
							echo "<td>".($row1['subject8'])."</td>";
					echo "</tr>";
					}
					else{
						echo "<script type='text/javascript'>alert('Date does not exist in the database.')</script>";
						break;
					}
				$count++;
				$startDate = $startDate->add(new DateInterval('P1D'));
				
			}
	?>
  </table>
</div>
 <div>
	<table class='options' border='0' cellpadding='5' cellspacing='0'>
		<tr class='time'>
			<th></th>
			<th>Initial Date</th>
			<th>e-DCWR</th>
		</tr>
		<tr>
			<td class='days'></td>
			<td class='text'><input type="date" style="font-size: 1.3rem" name="start_date" min="2016-06-02" max="2016-12-20"></td> 
			<td class="text green" ><a href="home.php" >Go back</a></td>
		</tr>
	</table>
  </div>
 </body>
</html>
