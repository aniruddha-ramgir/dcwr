<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>eDCWR</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
		<link rel="stylesheet" href="css/login.css">
</head>
<body>    
<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Additional Information Required</h1>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">DCWR Details</h1>
    <form role = form action="admin_process.php" method="post">
	<div class="input-container">
        <input type="text" name="batch" required="required"/>
        <label for="Username">Batch</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" name="section" required="required"/>
        <label for="Username">Section</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" name="year" required="required"/>
        <label for="Username">Year</label>
        <div class="bar"></div>
      </div>
	  <div class="input-container">
        <input type="text" name="semester" required="required"/>
        <label for="Username">Semester</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button type="submit" name="submit" ><span>Submit</span></button>
      </div>
    </form>
  </div>
  <div class="card alt">
    <div class="toggle"></div>
    <h1 class="title">Register
      <div class="close"></div>
    </h1>
    <form role = form action="create.php" method="post">
      <div class="input-container">
        <input type="text" name="section" required="required"/>
        <label for="Username">Section</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" name="year" required="required"/>
        <label for="Username">Year</label>
        <div class="bar"></div>
      </div>
	  <div class="input-container">
        <input type="text" name="semester" required="required"/>
        <label for="Username">Semester</label>
        <div class="bar"></div>
      </div>
	   <div class="input-container">
        <input type="text" name="mentor" required="required"/>
        <label for="Username">Mentor ID</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button type="submit" name="submit" ><span>Submit</span></button>
      </div>
    </form>
  </div>
</div>
<script src='js/button.js'></script>
 <script src="js/index.js"></script>
  </body>
</html>
