<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/stylesheet2.css">
</head>
<style>

#header{
  color:wheat;
  font-size: 1.6em;
  font-family: sans-serif;
  margin-bottom: 5%;
}
.tbl{
  border-collapse: collapse;
  border-width: 3px;
}
th,td{
  padding: 6px;
}
</style>
<body>
    <?php 
    @session_start();
    if($_SESSION['is_verified']==false)
    {
    echo "<script>alert('Unauthorized Access.Login REquired')</script>";
    header("Location:../login.php");
    }
    if($_SESSION['user']=="faculty")
    {
        header("Location:start.php");
    }
    $username=$_SESSION["username"];
    $roll_no=$_SESSION["roll_no"];
    echo "<h1 id='header'>Hello $username $roll_no</h1>";
    $conn=mysqli_connect("localhost","root","","project");
    if($conn -> connect_error)
	{
		die("Connection error".$conn -> connect_error);
    }
    $name_query="select NAME from project where ROLL_NO='$roll_no' ";
    $name_res=mysqli_query($conn,$name_query);
    if(mysqli_num_rows($name_res)==0)
    {
        echo "<br>No Student Result Data Found";
    }
    else{
        $name_assoc=mysqli_fetch_assoc($name_res);
        $name=$name_assoc['NAME'];
 ?>
 <img src="../images/print.jpeg" onclick="printFunction()" style="margin-top: -10%;margin-left: 90em; width: 4em ;height: 4em">
 <table border="1" class="tbl">
 <thead>
 <th>Name</th>
 <th>Roll No</th>
 <th>Subject Code</th>
 <th>Exam Date</th>
 <th>Semester</th>
 <th>S1WMS</th>
 <th>S2WMS</th>
 <th>S3WMS</th>
 <th>S4WMS</th>
 <th>S5TMS</th>
 </thead>
 <?php 
 $query="select * from project where NAME='$name' ";
 $res=mysqli_query($conn,$query);
 while($row=mysqli_fetch_array($res))
        {
          $S1WMS=$row['S1WMS'];
          $S2WMS=$row['S2WMS'];
          $S3WMS=$row['S3WMS'];
          $S4WMS=$row['S4WMS'];
          $S5TMS=$row['S5TMS'];

            echo "<tr>
            <td>$row[2]</td>
            <td>$row[0]</td>
            <td>$row[3]</td>
            <td>$row[4]</td>
            <td>$row[5]</td>
            <td>$S1WMS</td>
            <td>$S2WMS</td>
            <td>$S3WMS</td>
            <td>$S4WMS</td>
            <td>$S5TMS</td>
            </tr>";
        }

    }
 ?>
 </table>
</body>
</html>