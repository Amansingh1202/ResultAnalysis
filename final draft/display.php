<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3>instru branch<br>sem 6<br>first shift<br></h3>
<table border="1">
	<tr>
		<th><h3>subject</h3></th>
		<th><h3>appeared</h3></th>
		<th><h3>above 48</h3></th>
		<th><h3>btw 32 n 48</h3></th>
		<th><h3>pass</h3></th>
		<th><h3>fail</h3></th>
		<th><h3>percentage</h3></th>

	</tr>
	<?php 
	if (isset($_POST['submit']))
	{
		$br=$_POST['branch'];
		$sem=$_POST['semester'];
		$shft=$_POST['shift'];
		echo "$br\r\n";
		echo "$sem \r\n";
		echo "$shft \r\n";

	}

	$conn=mysqli_connect("localhost","root", "new_password","project");
	
	$i=0;
	if($conn -> connect_error)
	{
		die("Connection error".$conn -> connect_error);
	}
	$sub=1;
	while($sub<=5)
	{	
		$above_48=0;
		$pass=0;
		$fail=0;
		$bet32_48=0;
		echo "<tr><td>";
		//no of appeared students 
		echo "S".$sub."WMS</td>";
		$attribute="S".$sub."WMS";
		$sql1="SELECT $attribute FROM project where BRANCH='$br' AND SEMESTER='$sem' AND SHIFT='$shft' and NOT $attribute='ABS' ";
		$res1=$conn-> query($sql1);
		echo "<td>$res1->num_rows</td>";
		//marks above 48
		while ($row=$res1->fetch_assoc()) {
			$cell=$row["$attribute"];
			$marks=0;
			for($i=0;$i<=strlen($cell);$i++)
			{
				if (is_numeric($cell[$i])) {
					$dig=(int)$cell[$i];
					$marks=$marks*10+$dig;
				}
				else 
				{
					break;
				}
			}
			if ($marks>48)
			{
				$above_48+=1;			
			}
			elseif ($marks>32 && $marks<=48) 
			{
				$bet32_48+=1;
			}
			if ($marks>=32) {
				$pass+=1;
			}

		}
		$fail=$res1->num_rows-$pass;
		$pass_percent=($pass/$res1->num_rows)*100;

		echo "<td>$above_48</td>";
		echo "<td>$bet32_48</td>";
		//no of pass students
		echo "<td>$pass</td>";
		echo "<td>$fail</td><td>";
		printf("%.2f",$pass_percent);

		echo "%</td></tr>";
		$sub++;

	}

	?>

</table>
</body>
</html>
