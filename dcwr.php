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
<form role = form method="get" action="dcwr.php">
 <div>
	<table class='options' border='0' cellpadding='5' cellspacing='0'>
		<tr class='time'>
			<th>Initial Date</th>
			<th>Plan</th>
			<th>e-DCWR</th>
		</tr>
		<tr>
			<td class='text'><input name="date" type="date" style=" font-size: 1.3rem" min="2016-06-02" max="2016-12-20"></td>
			<td class="text green" ><input type="submit" value="UPDATE" class="button2 text green " name="update" ></td>
			<td class="text red" ><a href="javascript:history.go(-1)" >Go back</a></td> <!-- Goes back to actual previous page -->
		</tr>
	</table>
  </div>
 </form>
 </body>
</html>
