<th>INCLUDE</th>
if(isset($_POST['update'])){
				$count=0;
				$ErrorCount=0;
				while($count < 6){
				$sql1 = $conn->query(" SELECT * FROM `reports_topic_data` WHERE date = '" . $dateString . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
				$sql2 = $conn->query(" SELECT * FROM `reports_subject_data` WHERE date = '" . $dateString . "' and dcwr_id = " . $_SESSION['dcwr_id'] . " ");
				}
			}
			
echo '<td class="text" ><div class="onoffswitch">
								<input type="checkbox" form="myForm" name="onoffswitch" class="onoffswitch-checkbox" id="switch'.$count.'">
								<label class="onoffswitch-label" for="switch'.$count.'">
								<span class="onoffswitch-inner"></span>
								<span class="onoffswitch-switch"></span>
								</label>
								</div></td>';