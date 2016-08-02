<?php
include("connection.php");
$sql= " SELECT * FROM login where user_name = '$_POST[user]' AND pass = '$_POST[pass]'";
$result = $conn->query($sql);
if(!empty($row = $result->fetch_assoc())){
	$_SESSION['user_id'] = $row['user_id'];
	if($row['type_id']=='A'){
		header('Location: admin_info.php');
	}
	else if($row['type_id']=='C'){
		header('Location: incharge_process.php');
	}
	else{
		header('Location: incharge_process.php');
	}
}
else {
	//session_unset();
	//session_destroy(); 
	$conn->close();
	echo "Incorrect Username and/or password";
}
?>