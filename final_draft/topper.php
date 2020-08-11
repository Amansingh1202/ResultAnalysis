<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toppers List</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/stylesheet2.css">
</head>
<body>
    <?php 
    @session_start();
    if($_SESSION['is_verified']==false)
    {
        echo "<script>alert('Unauthorized Access.Login REquired')</script>";
        header("Location:../login.php");
    }
    else{
        if($_SESSION['user']=="student")
        {
            header("Location:student.php");
        }
        elseif ($_SESSION['user']=='faculty') {
            $username=$_SESSION['username'];
            $sdrn=$_SESSION['sdrn'];
        }
    }
    $conn=mysqli_connect("localhost","root","","project");
    if($conn -> connect_error)
	{
		die("Connection error".$conn -> connect_error);
    }
    if(isset($_POST['topper_submit']))
	{
		$br=$_POST["branch"];
		$e_date=$_POST["e_date"];
    }
    else{
        $br="";
        $e_date="";
    };
    echo "<img src='images/print.jpeg' onclick='printFunction()'' style='margin-top: 2em;margin-left: 70%; width: 4em ;height: 4em'>";
    for($i=3;$i<=6;$i++)
    {
        $query="select * from project where SEMESTER='$i' and E_DATE='$e_date' and BRANCH='$br' and SUB_CODE='all' order by C_SG_TOTAL desc limit 10 ";
        $res=mysqli_query($conn,$query);
        echo "<table border='1'>
        <thead><td colspan='4' align='center'>Semester $i</td></thead>
        <thead>
        <th>Roll No</th>
        <th>Name</th>
        <th>Exam Date</th>
        <th>Total Marks</th></thead>
        ";
        while($data=mysqli_fetch_array($res))
        {
            $total_marks=$data['C_SG_TOTAL'];
            echo "<tr>
            <td>$data[0]</td>
            <td>$data[2]</td>
            <td>$data[4]</td>
            <td>$total_marks</td></tr>";
        }
        echo "</table><br>";
    }
    
    ?>
</body>
<script>
function printFunction() {

window.print();

}
</script>
</html>