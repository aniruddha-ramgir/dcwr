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
						
?>