<!DOCTYPE html>
<html>
<head>
	<title></title>
		<link rel="stylesheet" href="css/stylesheet2">
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<style>
	.center {
  margin: auto;
  width: 50%;
  border: 5px solid white;
  padding: 10px;
}
</style>

<body>
<img src="images/print.jpeg" onclick="printFunction()" style="margin-top: 2em;margin-left: 120em; width: 4em ;height: 4em">

<table border="1" class="center">
	<tr>
		<th><h3>class</h3></th>
		<TH><h3>semester</h3></TH>
		<TH><h3>appeared</h3></TH>
		<TH><h3>distinction</h3></TH>
		<TH><h3>first class</h3></TH>
		<TH><h3>second class</h3></TH>
		<TH><h3>total pass</h3></TH>
		<TH><h3>failed</h3></TH>
		<TH><h3>total %</h3></TH>
	</tr>
<?php 	
	if(isset($_POST['submit']))
	{
		$br=$_POST["branch"];
		$e_date=$_POST["e_date"];
	}
	$conn=mysqli_connect("localhost","root","new_password","project");

	


?>


	<tr>
		<td rowspan="6">Second Year</td>
		<td rowspan="3">(III)1st Shift</td>
	</tr>	

</table>


</body>
</html>