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
			$count=1;
			while($count < 7){
				$dateString = $startDate->format('Y-m-d');
				$sql = $conn->query(" SELECT * FROM `schedule_data` WHERE day = '" . $count . "' and dcwr_id = " . $_SESSION['plan_id'] . " ");
					if( !empty( $row1 = $sql->fetch_assoc() ) ){
						echo "<tr>";
							echo "<td class='days'>" . $count . "</td>";
							echo "<td>".($row1['1H'])."</td>";
							echo "<td>".($row1['2H'])."</td>";
							echo "<td>".($row1['3H'])."</td>";
							echo "<td>".($row1['4H'])."</td>";
							echo "<td>".($row1['5H'])."</td>";
							echo "<td>".($row1['6H'])."</td>";
							echo "<td>".($row1['7H'])."</td>";
							echo "<td>".($row1['8H'])."</td>";
					echo "</tr>";
					}
					else{
						echo "<script type='text/javascript'>alert('Day does not exist in the database.')</script>";
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
			<th>e-DCWR</th>
		</tr>
		<tr>
			<td class="text green" ><a href="home.php" >Go back</a></td>
		</tr>
	</table>
  </div>
 </body>
</html>