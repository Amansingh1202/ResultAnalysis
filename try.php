<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<table border="1">
<tr>
	<th>S1wms</th>
</tr>

<?php 
	$conn= mysqli_connect("localhost","root","new_password","project");

if ($conn -> connect_error)
 {die("Connection Failed:".$conn -> connect_error);
		}
$i=2;
$res="S".$i."WMS";
	$sql = "SELECT $res FROM  PROJECT ";
	$result = $conn -> query($sql);
	echo "$result->num_rows";
	if ($result -> num_rows>0) {
		while ($row =$result-> fetch_assoc()) {
			echo "<tr><td>".$row["S".$i."WMS"]."</td></tr>";
		}
		echo "</table>";
	}
	else{
		echo "0 result";
	}
	$conn-> close();


?>

</table>

</body>
</html>