<?php
	include("connection.php");			
	include("logged_in.php");
	$result = $conn->query('SELECT * FROM `admins` WHERE dept_id=' . $_SESSION['user_id'] . ' ');
	if(!empty($row = $result->fetch_assoc())){
			$dept_id = $row['dept_id'];
	}
	if(isset($_POST['section_name'])){
		$result= $conn->query("SELECT * FROM `sections` WHERE dept_id=".$dept_id." AND name='".$_POST['section_name']."'");
		if(!empty($row = $result->fetch_assoc())){
			$section_id = $row['section_id'];
		}
		$result= $conn->query("SELECT * FROM `reports` WHERE section_id=" . $section_id . " AND (year=" . $_POST['year'] . " AND semester=" .$_POST['semester']. " )");
		if(!empty($row = $result->fetch_assoc())){
			$dcwr_id = $row['dcwr_id'];
		}
		if(isset($_POST['cr_id'])){ //update CR id, if entered on setup.php
			$conn->query("UPDATE `reports` SET `cr_id` = ".$_POST['cr_id']." WHERE `reports`.`dcwr_id` = ".$dcwr_id.""); //update cr_id
		}
		if(isset($_POST['incharge_id'])){ //update INcharge id, if entered on setup.php
			$conn->query("UPDATE `reports` SET `mentor_id` = ".$_POST['incharge_id']." WHERE `reports`.`dcwr_id` = ".$dcwr_id.""); //update incharge_id
		}
	}
	$target_dir ="uploads/";
	$error=0;
	if(isset($_POST['plan']) && !empty($_FILES))
	{
		include("connection.php");			
		include("logged_in.php");
		if(!empty($_FILES['plan_data']['name']))
		{ //create plan_id if doesnt exist already
			$result = $conn->query('SELECT COUNT(*) AS SUM FROM `plans` WHERE dept_id=' . $dept_id . ' AND ( batch= ' . $_POST['batch'] . ' AND ( year=' . $_POST['year'] . ' AND semester=' .$_POST['semester']. ' ) ) ');
			if(!empty($row=$result->fetch_assoc())){ //Add to reports table only if the record does not exist //does not work. It will not enter the if statement, if the record does not exist
				if ($row['SUM'] >0 ){
					//echo "<script type='text/javascript'>alert('Plan already exists!.')</script>"; //remove this in final version
				}
				else{
					if ($conn->query('INSERT INTO `plans`(`dept_id`, `batch`, `year`, `semester`, `admin_id`) VALUES ( ' . $dept_id . ',' . $_POST['batch'] . ',' . $_POST['year'] . ',' . $_POST['semester'] . ',' . $_SESSION['user_id'] . ')') === TRUE){
						echo "<script type='text/javascript'>alert('Plan_id created!.')</script>"; //remove this in final version
					}
					else{
						echo "<script type='text/javascript'>alert('Could not assign Plan_ID for the entered details.')</script>";
						return;
					}
				}
			}
			$target	= $target_dir . basename($_FILES["plan_data"]["name"]);
			upload_csv($target,"plan_data");
			unlink($target);
		}
		if(!empty($_FILES['schedule_data']['name']))
		{
			$target = $target_dir . basename($_FILES["schedule_data"]["name"]);
			upload_csv($target,"schedule_data");
			unlink($target);
		}
		if (!empty($_FILES['subject_list']['name']))
		{
			$target = $target_dir . basename($_FILES["subject_list"]["name"]);
			upload_csv($target,"subject_list");
			unlink($target);
		}
		switch($error){ //report back to setup with the outcome
			case 0:
				header('Location: setup.php?result=0');
				break;
			case 1:
				header('Location: setup.php?result=1');
				break;
			case 2:
				header('Location: setup.php?result=2');
				break;
		}
	}
	function upload_csv($target_file,$name)
	{
		include("connection.php");			
		include("logged_in.php");
		//echo $name;
		$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if($fileType!= "csv"){ //Not allowing other then (.csv) extension .  
			echo "<script type='text/javascript'>alert('Only csv allowed')</script>";
		}
		else{
			if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
				if (($getdata = fopen($target_file, "r")) !== FALSE) {
					fgetcsv($getdata);
					$count=0;
					while (($data = fgetcsv($getdata)) !== FALSE) {
						$fieldCount = count($data);
						for ($c=0; $c < $fieldCount; $c++) {
							$columnData[$c] = $data[$c];
							$columnData[$c]  = $conn->real_escape_string($columnData[$c]);
							if($c==0){
								$import_data	=	"('".$columnData[$c]."'";
							}
							else{
								$import_data	=	$import_data . ",'".$columnData[$c]."'"; //append all values
							}
						}	
						$import_data	= $import_data . ")"; //end
						$import[$count]	= $import_data;
						$count++;
					}
					//$import_data = implode(",", $import_data); //output = (),(), ...
					//	print_r($import);  //used to debug any issues
					switch ($name) {
						case "plan_data":
							for ($c=0; $c < $count ; $c++) { //iterate through rows
								if($c==0 || $c % 2 == 0){
									$conn->query("INSERT INTO plans_subject_data(plan_id, subject1, subject2, subject3, subject4, subject5, subject6, subject7, subject8, date) VALUES  $import[$c] ");  // SQL Query to insert data into DataBase
								}
								else{
									$conn->query("INSERT INTO plans_topic_data(plan_id, subject1, subject2, subject3, subject4, subject5, subject6, subject7, subject8, date) VALUES  $import[$c] ");  // SQL Query to insert data into DataBase
								}	
							}
							break;
							
						case "schedule_data":
							for ($c=0; $c < $count ; $c++) {
								$conn->query("INSERT INTO schedule_data(dcwr_id, day, 1H, 2H, 3H, 4H, 5H, 6H, 7H, 8H) VALUES  $import[$c] ");
							}
							break;
							
						case "subject_list":
							for ($c=0; $c < $count ; $c++) {
								$conn->query("INSERT INTO subject_list(plan_id, SUBJECT1, SUBJECT2, SUBJECT3, SUBJECT4, SUBJECT5, SUBJECT6, SUBJECT7, SUBJECT8, SUBJECT9, SUBJECT10) VALUES  $import[$c] ");
							}
							break;
							
						default:
							echo "This will not be displayed.";
							break;
					}
					echo "<script type='text/javascript'>alert('Upload success.')</script>";
					fclose($getdata); 
				}
			}
			else {
				echo "<script type='text/javascript'>alert('Error uploading.')</script>";
				$error++; //no of files that couldnt be uploaded
			}		
		}
	}
?> 