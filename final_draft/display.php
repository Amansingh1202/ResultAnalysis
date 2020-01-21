<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/stylesheet2">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<img src="images/print.jpeg" onclick="printFunction()" style="margin-top: 2em;margin-left: 120em; width: 4em ;height: 4em">
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
		$date=$_POST['e_date'];
		echo "$br\r\n";
		echo "$sem \r\n";
		echo "$shft \r\n<br>";
		echo "$date<br>";

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
		$sub_array[6][5];
		unset($sub_array);
		echo "<tr>";
	 //displaying subject name
		if($br=="T")
		{
			$sub_array= array(
				array("AM3","LD","DSA","DBMS","PC"),
				array("AM4","CN","OS","COA","AT"),
				array("MEP","IP","ADMT","CNS","DLOPT1"),
				array("SEPM","DMBI","CCS","DLOPT2"),
				array("END","IS","AI","DLOPT3","ILOPT1"),
				array("BGA","IOE","DPOPT4","ILOPT2","N/A")

			);
		}

		  elseif($br=="C")
		{
			$sub_array= array(
				array("AM3","DLD","DM","ECCF","DS"),
				array("AM4","AOA","COA","CG","OS"),
				array("MP","DBMS","CN","TCS","DLOPT1"),
				array("SE","SPCC","DWM","CSS","DLOPT2"),
				array("DSIP","MCC","AISC","DLOPT3","ILOPT1"),
				array("HMI","DC","DLPOPT4","ILOPT2","N/A")

			);
		}

		elseif($br=="I")
		{
			$sub_array= array(
				array("AM3","AE","T1","DE","ENM"),
				array("AM4","T2","FCS","AI","SCSD","ASP"),
				array("SNS","AOM","CSD","CSC","DLOPT1"),
				array("PIS","IDC","EMD","DSP","ACS"),
				array("IPC","BI","IA","DLOPT3","ILOPT1"),
				array("INSTRU PROJ","N/A","N/A","N/A","N/A")

			);
		}

		

		elseif($br=="X")
		{
			$sub_array= array(
				array("AM3","EDC1","DSD","CTN","EIC"),
				array("AM4","EDC2","LIC","SNS","PC"),
				array("MPI","DC","EE","DTSP","DLOPT1"),
				array("MCA","CCN","ARW","IPMV","DLOPT2"),
				array("ME","MCS","OC","DLOPT3","ILOPT1"),
				array("RFD","WN","DLOPT4","ILOPT2","N/A")

			);
		}

		elseif($br=="E")
		{
			$sub_array= array(
				array("AM3","EDC1","DCD","ENAS","EIM"),
				array("AM4","EDC2","MA","DSD","PC"),
				array("MCA","DC","EE","DLIC","BCE","DLOPT1"),
				array("ES","CCN","VLSI","SNS","DLOPT2"),
				array("ISD","PE","DSP","DLOPT3","ILOPT1"),
				array("IOT","AMVLSI","DLOPT4","ILOPT2","N/A")

			);
		}
		


		$arr_sem=$sem-3;
		$arr_sub=$sub-1;
		echo "<td>".$sub_array[$arr_sem][$arr_sub]."</td>";
		
		$attribute="S".$sub."WMS";
		
		$sql1="SELECT $attribute FROM project where BRANCH='$br' AND SEMESTER='$sem' AND SHIFT='$shft'and NOT $attribute='ABS' and E_DATE='$date' ";
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
<script>
	function printFunction() {

		window.print();

	}
	</script>
</html>
