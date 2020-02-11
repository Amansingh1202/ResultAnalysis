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
<table border="2" class="center">
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

	if ($conn ->connect_error)
	{
		die("connection error".$conn ->connect_error);
	}
	$sql1="SELECT C_SG_TOTAL FROM project where BRANCH='$br' and E_DATE='$e_date' and SEMESTER='3' and shift='1'";
	$res1=$conn-> query($sql1);
	$appeared=$res1->num_rows;
	$grade_o=0;
	$grade_a=0;
	$grade_b=0;
	$grade_c=0;
	$grade_d=0;
	$grade_e=0;
	$passed=0;
	while ($row=$res1->fetch_assoc()) {
		$cell=$row["C_SG_TOTAL"];
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

	
	#formula to find CGPA------------#
	$cgpi=(($marks/750)-11)/7.25;
	if($cgpi>=8.5)
		{$grade_o+=1;}
	if($cgpi>=7.5 and $cgpi<8.5)
		{$grade_a+=1;}
	if($cgpi>=6.5 and $cgpi<7.5)
		{$grade_b+=1;}
	if($cgpi>=6 and $cgpi<6.5)
		{$grade_c+=1;}
	if($cgpi>=5.5 and $cgpi<6)
		{$grade_d+=1;}
	if($cgpi>=5 and $cgpi<5.5)
		{$grade_e+=1;}



	}

	$sql2="SELECT REMARKS FROM project where BRANCH='$br' and E_DATE='$e_date' and SEMESTER='3' and shift='1' ";
	$res2=$conn->query($sql2);

	while($row2=$res2->fetch_assoc())
	{
		$cell2=$row2['REMARKS'];
		if($cell2=='P')
			$passed++;
	}
	$fail=$appeared-$passed;


		echo "<tr><td rowspan='6'>Second Year</td>";
		echo "<td rowspan='3'>(III)First Shift</td>";
		echo "<td rowspan='3'>$appeared</td>";
		echo "<td>Grade O:$grade_o</td>";
		echo "<td rowspan='3'>Grade C:$grade_c</td>";
		echo "<td>Grade D:$grade_d</td>";
		echo "<td rowspan='3'>$passed</td>";
		echo "<td rowspan='6'>$fail</td>";

		#empty cell for %pass percent
		echo "<td rowspan='6'></td></tr>";

		echo "<tr><td>Grade A:$grade_a</td>";
		echo "<td>Grade E:$grade_e</td></tr>";
		echo "<tr><td>Grade B:$grade_b</td>";
		echo "<td></td></tr>";
?>




</table>


</body>
<script>
	function printFunction() {

		window.print();

	}
	</script>
</html>
