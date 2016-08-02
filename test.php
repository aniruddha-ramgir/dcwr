<?php
	include("connection.php");
	$_SESSION['dcwr_id']=1;
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Test</title>
        <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
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
	$index= " SELECT * FROM `" . $_SESSION['dcwr_id'] . "` WHERE date = '" . date("Y-m-d") . "' ";  //get current date and nearest monday . And find its index.
	$result = $conn->query($index);
	if( !empty( $row = $result->fetch_assoc() ) ){
		$i=$row['index'];
		$count=0;
		while($count < 7){
			$sql = " SELECT * FROM `" . $_SESSION['dcwr_id'] . "` WHERE `index` = '" . $i . "' ";
			$result = $conn->query($sql);
				if( !empty( $row1 = $result->fetch_assoc() ) ){
					$date = DateTime::createFromFormat("Y-m-d", $row1['date']);
					echo "<tr>";
					if( !($row['CR']==0) ){
						echo "<td class='days'></td>";
						echo "<td>".($row['1H'])."</td>";
						echo "<td>".($row['2H'])."</td>";
						echo "<td>".($row['3H'])."</td>";
						echo "<td>".($row['4H'])."</td>";
						echo "<td>".($row['5H'])."</td>";
						echo "<td>".($row['6H'])."</td>";
						echo "<td>".($row['7H'])."</td>";
						echo "<td>".($row['8H'])."</td>";
						echo '<td class="text" ><div class="onoffswitch">
							<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch'.$i.'">
							<label class="onoffswitch-label" for="switch'.$i.'">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
							</label>
							</div></td>';
					}
					else{
						echo "<td class='days'>".$date->format("D"). "</td>";
						echo "<td contenteditable='true' class='text' >".($row1['1H'])."</td>";
						echo "<td contenteditable='true' class='text' >".($row1['2H'])."</td>";
						echo "<td contenteditable='true' class='text' >".($row1['3H'])."</td>";
						echo "<td contenteditable='true' class='text' >".($row1['4H'])."</td>";
						echo "<td contenteditable='true' class='text' >".($row1['5H'])."</td>";
						echo "<td contenteditable='true' class='text' >".($row1['6H'])."</td>";
						echo "<td contenteditable='true' class='text' >".($row1['7H'])."</td>";
						echo "<td contenteditable='true' class='text' >".($row1['8H'])."</td>";
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
					break;
				}
			$count++;
		}
	}
	else{
		echo "<script type='text/javascript'>alert('Date does not exist in the database.')</script>";
	}
?>
</table>
</div>
<div>
	<table class='options' border='0' cellpadding='5' cellspacing='0'>
		<tr class='time'>
			<th></th>
			<th>Initial Date</th>
			<th>DCWR</th>
			<th></th>
			<th>LESSON PLAN</th>
			<th></th>
			<th>SUBMIT</th>
		</tr>
		<tr>
			<td class='days'></td>
			<td class='text'><input type="date" style="font-size: 1.3rem" name="start_date" min="2016-06-02" max="2016-12-20"></td> 
			<td class="text green" ><a href="test.php?date=' . urlencode('start_date') . '" >UPDATE</a></td>
			<td><?php echo 'start_date'?></td>
			<td class="text purple" ><a href="#" >VIEW</a></td>
			<td></td>
			<td class="text green" ><a href="#" >SUBMIT</a></td>
		</tr>
	</table>
  </div>
 </body>
</html>
</body>
</html>