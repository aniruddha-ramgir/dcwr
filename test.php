<?php
if( !($row1['Admin']==0) ){
	echo "<td class='days ' >".$startDate->format("D"). "</td>";
	for($i=1;$i<9;$i++){
		echo "<td class='info ' data-tooltip=' ".($row2["'".$i."H'"])." '>".($row1["'".$i."H'"])."</td>";
	}

						//if( !($row1['Admin']==0) ){
							echo "<td class='days ' >".$startDate->format("D"). "</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['1H'])." '>".($row1['1H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['2H'])." '>".($row1['2H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['3H'])." '>".($row1['3H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['4H'])." '>".($row1['4H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['5H'])." '>".($row1['5H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['6H'])." '>".($row1['6H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['7H'])." '>".($row1['7H'])."</td>";
							echo "<td class='info ' data-tooltip=' ".($row2['8H'])." '>".($row1['8H'])."</td>";
						}
						else{
							//echo "<td class='days'>".$startDate->format('Y-m-d'). "</td>"; //date instead of day
							echo "<td class='days ' >".$startDate->format("D"). "</td>";		//contenteditable will not work without javascript. Better remove this part of the code
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['1H'])." '>".($row1['1H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['2H'])." '>".($row1['2H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['3H'])." '>".($row1['3H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['4H'])." '>".($row1['4H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['5H'])." '>".($row1['5H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['6H'])." '>".($row1['6H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['7H'])." '>".($row1['7H'])."</td>";
							echo "<td class='info ' contenteditable='true' class='text' data-tooltip=' ".($row2['8H'])." '>".($row1['8H'])."</td>";
						}	
						 //Everything written below is to create empty records in the Database. I don't think it is necessary anymore. (because there was no dedicated dcwr entry page earlier.)
				
				/*	$reports = ' SELECT * FROM reports WHERE section_id=' . $_SESSION['section_id'] . ' AND ( year=' . $_SESSION['year'] . ' AND semester=' .$_SESSION['semester']. ' ) ';
					$result = $conn->query($reports); //get dcwr_id and create a table with that dcwr_id
					if($_SESSION['semester']==1){ //pick a date based on the semester. Either get those dates from admin or use fixed dates. June X to Dec Y - Sem 1, Jan X - April Y - Sem 2
						$startDate = new DateTime('2016-06-01'); //year should be dynamic.
					}
					else if($_SESSION['semester']==2){
						$startDate = new DateTime('2016-01-01');
					}
					else{
						echo "<script type='text/javascript'>alert('Invalid semester!')</script>";
					}
					if(!empty($row = $result->fetch_assoc())){  
						//echo $_SESSION['dcwr_id'];
						$count=0;
						while($count<33){ // number of days in a semester = 120
							$dateString = $startDate->format('Y-m-d');
							$create1 = 'INSERT INTO `reports_subject_data` (`dcwr_id`, `date`)  VALUES (' . $row['dcwr_id'] . ',"' . $dateString . '" )'; //Adding empty subjects
							$create2 = 'INSERT INTO `reports_topic_data` (`dcwr_id`, `date`)  VALUES (' . $row['dcwr_id'] . ',"' . $dateString . '" )';	//Adding empty topics
							if ($conn->query($create1) === TRUE & $conn->query($create2) === TRUE) { //check if its succesfully added then, increment count. Else, display error.
								$count++;
								$startDate = $startDate->add(new DateInterval('P1D'));
								header('Location: admin_info.php');
								exit();
							}
							else{
								echo "<script type='text/javascript'>alert('Could not add Empty Subject and/or topic record.')</script>";
								break;
							}
						}
						echo "<script type='text/javascript'>alert('Record created sucessfully')</script>";
					} */
						
?>