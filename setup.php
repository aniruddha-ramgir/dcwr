<?php
	include("connection.php");			
	include("logged_in.php");
	if (isset($_GET['result'])){
		switch($_GET["result"]){
			case 0:
				echo "<script type='text/javascript'>alert('Upload success.')</script>";
				break;
			case 1:
				"<script type='text/javascript'>alert('1 upload failed.')</script>";
				break;
			case 2:
				"<script type='text/javascript'>alert('2 uploads failed.')</script>";
				break;
		}
	}
?> 
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>System Setup</title>
        <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
    <!-- / eDCWR -->
<form role = form method="post" action="upload.php" enctype="multipart/form-data">
	<input type="submit" id="submit-form" name="plan" style="display:none;" >
	<div class='tab'>
		<table align="center" border='0' cellpadding='0' cellspacing='0'>			
			<tr class='time'>
				<th>Batch</th>
				<th>Year</th>
				<th>Semester</th>
			</tr> 
			<tr>
				<!-- batch -->
				<?php 	//Extract batch years from Sections table
					$sql = $conn->query("SELECT DISTINCT `batch` FROM `sections` ORDER BY `batch` DESC "); //GET ALL Batches in the database
					$rows = $sql->fetch_all(MYSQLI_ASSOC); //I dont get this part either. http://stackoverflow.com/questions/8849201/how-to-load-mysqli-result-set-into-two-dimensional-array
					$result = array_column($rows, 'batch'); // http://php.net/manual/en/function.array-column.php 
					//Both above lines are used to convert a single column into a 2D array with index. 
					echo "<td class='text' >"; 
						echo '<select class="select-style" name="batch">';
							for($count=0;$count<4;$count++){ //Go through 4 most recent batches (descending order)
								if(($result[$count])!=NULL){  //display only if its not NULL. USELESS
									echo '<option value="' .$result[$count]. '">' . ($result[$count]) . '</option>'; //echo each row in the column using index.
								}
							}
						echo "</select>";
					echo "</td>";
				?>
				<td class='text'>  <!-- Year -->
					<select class="select-style" name="year">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
				</td>
				<td class='text'>  <!-- Semester -->
					<select class="select-style" name="semester">
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</td>
			</tr>
			<tr>
				<th class='time'>Section</th>
				<th class='time'>Assign CR</th>
				<th class='time'>Assign Incharge</th>
			</tr> 
			<tr>
			<!-- section name -->
				<?php 	//Extract section names from Sections table
					$sql = $conn->query("SELECT DISTINCT `name` FROM `sections` "); //GET ALL section names in the database
					$rows = $sql->fetch_all(MYSQLI_ASSOC); 
					$result = array_column($rows, 'name'); 
					//Both above lines are used to convert a single column into a 2D array with index. 
					echo "<td class='text' >"; 
						echo '<select class="select-style" name="section_name">';
						echo '<option disabled selected value>select</option>';
							foreach($result as $res){ //Go through 4 most recent batches (descending order)
									echo '<option value="' .$res. '">' . ($res) . '</option>'; //echo each row in the column using index.
							}
						echo "</select>";
					echo "</td>";
				?>
				<?php 	//Extract CR IDs from Sections table
					$sql = $conn->query("SELECT `user_id` FROM `login` WHERE `type_id`='C' "); //GET ALL section names in the database
					$rows = $sql->fetch_all(MYSQLI_ASSOC); 
					$result = array_column($rows, 'user_id'); 
					//Both above lines are used to convert a single column into a 2D array with index. 
					echo "<td class='text' >"; 
						echo '<select class="select-style" name="cr_id">';
						echo '<option disabled selected value>select</option>';
							foreach($result as $res){ //Go through 4 most recent batches (descending order)
									echo '<option value="' .$res. '">' . ($res) . '</option>'; //echo each row in the column using index.
							}
						echo "</select>";
					echo "</td>";
				?>
				<?php 	//Extract Incharge IDs from Sections table
					$sql = $conn->query("SELECT `user_id` FROM `login` WHERE `type_id`='F' "); //GET ALL section names in the database
					$rows = $sql->fetch_all(MYSQLI_ASSOC); 
					$result = array_column($rows, 'user_id'); 
					//Both above lines are used to convert a single column into a 2D array with index. 
					echo "<td class='text' >"; 
						echo '<select class="select-style" name="incharge_id">';
						echo '<option disabled selected value>select</option>';
							foreach($result as $res){ //Go through 4 most recent batches (descending order)
									echo '<option value="' .$res. '">' . ($res) . '</option>'; //echo each row in the column using index.
							}
						echo "</select>";
					echo "</td>";
				?>
			</tr>
			<tr>
				<th class='time'>Lesson Plan</th>
				<th class='time'>Subject list</th>
				<th class='time'>Schedule</th>
			</tr> 
			<tr>
				<td  class='text purple'>
					<div class="fileUpload btn btn-primary">
					<span>Upload</span><input class="upload" name="plan_data" id="plan_data" type="file" /></div>
				</td>
				<td  class='text blue'><div class="fileUpload btn btn-primary">
					<span>Upload</span><input class="upload" name="subject_list" id="subject_list" type="file" /></div>
				</td>
				<td  class='text purple'><div class="fileUpload btn btn-primary">
					<span>Upload</span><input class="upload" name="schedule_data" id="schedule_data" type="file" /></div>
				</td>
			</tr>
		</table>
	</div>
</form>
<form role = form method="get" action="setup.php"> <!-- check if role and action are necessary -->
 <div>
	<table align=center class='options' border='0' cellpadding='5' cellspacing='0'>
		<tr class='time'>
				<th>SUBMIT</th>
				<th>LOG OUT</th>
			</tr> 
		<tr>
			<!-- <td	 class="text green" ><input name="submit" value="SUBMIT" type="submit" class="button2 text green "></td> -->
			<td class="text green" ><label for="submit-form" class="button2 text green " >SUBMIT</label></td>
			<td class="text red"><a href="logout.php" >LOG OUT</a></td>
		</tr>
	</table>
  </div>
 </form>
 </body>
</html>