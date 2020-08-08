<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
    echo "Hello $username $roll_no";
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
 <table border="1">
 <thead>
 <th>Name</th>
 <th>Roll No</th>
 <th>Subject Code</th>
 <th>Exam Date</th>
 <th>Semester</th>
 <th>S1WMS</th>
 </thead>
 <?php 
 $query="select * from project where NAME='$name' ";
 $res=mysqli_query($conn,$query);
 while($row=mysqli_fetch_array($res))
        {
            echo "<tr>
            <td>$row[2]</td>
            <td>$row[0]</td>
            <td>$row[3]</td>
            <td>$row[4]</td>
            <td>$row[5]</td>
            <td>$row[8]</td>
            </tr>";
        }

    }
 ?>
 </table>
</body>
</html>