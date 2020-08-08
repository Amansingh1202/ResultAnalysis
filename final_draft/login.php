<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<style>
.container{
	margin-top:15%;
	margin-left:20%;
}
.label{
	color:grey;
	font-size:1.2em;
	font-family:sans-serif;
}
.heading{
	color:indianred;
	font-size:1.1em;
}
.btn{
	background-color: #1b6d85;
	padding:5px 8px 5px 8px;
	color:white;
	border-radius:5px;
}

.btn:hover {
    background-color: #5bc0de;
    color: black;
}
</style>
<body>
<div class="container">
	<div>
		<label class="label">SignUp For Students:</label>
		<form action="#" method="POST">
			<label class="heading" for="username">Username:</label>
			<input type="text" name="username" placeholder="Enter username" id="username" required>
			<label class="heading" for="roll_no">Roll No:</label>
			<input type="text" name="roll_no" placeholder="Enter Roll No" id="roll_no" required>
			<label class="heading" for="password">Password:</label>
			<input type="password" name="password" placeholder="Enter Password" id="password" required="">
			<input class="btn" type="submit" name="sign_up" value="SignUp">

		</form>
	</div>
<br>

	<div>
		<label class="label">Login for Students:</label>
		<form action="#" method="POST">
			<label class="heading" for="username">Username:</label>
			<input type="text" name="username" placeholder="Enter Username" id="username" required>
			<label class="heading" for="password">Password</label>
			<input type="password" name="password" placeholder="Enter Password" id="password" required>
			<input class="btn" type="submit" name="login_student" value="Student Login">
		</form>
	</div>
<br>

	<div>
		<label class="label">Login For Faculty:</label>
		<form action="#" method="POST">
			<label class="heading" for="sdrn">SDRN</label>
			<input type="text" name="sdrn" placeholder="Enter SDRN" id="sdrn" required>
			<label class="heading" for="password" >Password</label>
			<input type="password" name="password" placeholder="Enter Password" id="password" required>
			<input class="btn" type="submit" name="login_faculty" value="Faculty Login">
		</form>
	</div>
	</div>
<?php 
	@session_start();
	$_SESSION['is_verified']=false;
	$conn=mysqli_connect("localhost","root","","project");
	if($conn -> connect_error)
	{
		die("Connection error".$conn -> connect_error);
	}

	if(isset($_POST["sign_up"]))
	{
		$username=$_POST["username"];
		$roll_no=$_POST["roll_no"];
		$password=$_POST["password"];

		$check_sql="SELECT * from  student_login_info where Roll_No='$roll_no' or Username='$username' ";
		$check_res=mysqli_query($conn,$check_sql);
		if(mysqli_num_rows($check_res)>0)
		{

			echo "<script> alert('Student with Roll NO:$roll_no already exists.')</script>";
			
		}
		else{
			
			$insert_sql="INSERT INTO `student_login_info`(`Username`,`Roll_No`,`Password`) VALUES ('$username','$roll_no','$password'); ";
			$res2=mysqli_query($conn,$insert_sql);
			if($res2)
			{
				echo "<script>alert('New Student Info Created')</script>";
			}
		}
		
	}

	if(isset($_POST['login_student']))
	{
		$username=$_POST["username"];
		// $roll_no=$_POST["roll_no"];
		$password=$_POST["password"];

		$verify_query="SELECT * from student_login_info where Username='$username' and Password='$password' ";
		$res=mysqli_query($conn,$verify_query);
		if(mysqli_num_rows($res)>0)
		{
			$_SESSION['is_verified']=true;
			$_SESSION['username']=$username;
			$row=mysqli_fetch_assoc($res);
			$roll_no=$row['Roll_No'];
			$_SESSION['roll_no']=$roll_no;
			$_SESSION['user']="student";
			echo "<script>alert('Successfully Logged In')</script>";
			header('Location:html/start.php');
		}
		else
		{
			echo "<script>alert('Login Unsuccessful')</script>";
		}
	}

	if(isset($_POST['login_faculty']))
	{
		$sdrn=$_POST["sdrn"];
		// $roll_no=$_POST["roll_no"];
		$password=$_POST["password"];

		$verify_query="SELECT * from faculty_login_info where SDRN='$sdrn' and Password='$password' ";
		$res=mysqli_query($conn,$verify_query);
		if(mysqli_num_rows($res)>0)
		{
			$_SESSION['is_verified']=true;
			$_SESSION['sdrn']=$sdrn;
			$row=mysqli_fetch_assoc($res);
			$username=$row['Username'];
			$_SESSION['username']=$username;
			$_SESSION['user']="faculty";
			echo "<script>alert('Successfully Logged In')</script>";
			header('Location:html/start.php');
		}
		else
		{
			echo "<script>alert('Faculty Login Unsuccessful')</script>";
		}
	}




?>
</body>
</html>