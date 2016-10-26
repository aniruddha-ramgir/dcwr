<?php
	if(isset($_POST['submit'])){
			validate();
	}
	function validate(){
		include("connection.php");
		$result = $conn->query(" SELECT * FROM login where user_name = '$_POST[user]' AND pass = '$_POST[pass]'");
		if(!empty($row = $result->fetch_assoc())){
			$_SESSION['logged_in']=1;
			$_SESSION['user_id'] = $row['user_id'];
			if($row['type_id']=='A'){
				unset($_GET['loginFailed']);
				header('Location: admin_info.php');
				exit();
			}
			else if($row['type_id']=='C'){
				unset($_GET['loginFailed']);
				header('Location: incharge_process.php');
				exit();
			}
			else{
				unset($_GET['loginFailed']);
				header('Location: incharge_process.php');
				exit();
			}
		}
		else {
			session_unset();
			session_destroy(); 
			$conn->close();
			//echo "<script type='text/javascript'>alert('Incorrect Username and/or password')</script>";
			header('Location: login.php?loginFailed=incorrect'); //Incorrect password message is not being displayed if this line executes
			die();
		}
	}
	if (isset($_GET['loginFailed'])){
		if($_GET["loginFailed"]=="incorrect"){
			echo "<script type='text/javascript'>alert('Incorrect Username and/or password')</script>";
		}
		if($_GET["loginFailed"]=="AuthFailed"){
			echo "<script type='text/javascript'>alert('Authorization Failed. You are not allowed to access the current DCWR.')</script>";
		}
		
	}
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login to eDCWR</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
		<link rel="stylesheet" href="css/login.css">
</head>
<body>    
<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>eDCWR</h1>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Login</h1>
    <form role = form action="login.php" method="post">
      <div class="input-container">
        <input type="text" name="user" required="required"/>
        <label for="Username">Username</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" name="pass" required="required"/>
        <label for="Password">Password</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button type="submit" name="submit" ><span>Submit</span></button>
      </div>
      <div class="footer"><a href="#">Forgot your password?</a></div>
    </form>
  </div>
</div>
  </body>
</html>
