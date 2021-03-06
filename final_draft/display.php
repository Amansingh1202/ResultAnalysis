<!DOCTYPE html>
<html>
<head>
	<title>Subject Wise Result Analysis</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/stylesheet2.css">
<script type="text/javascript">
function myGraph(){

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1",
	animationEnabled: false,		
	title:{
		text: "Subjectwise Analysis"
	},
	data: [
	{
		type: "column",
		dataPoints: [
			{ label: subjects[0],  y: parseFloat(passedarray[0]) },
			{ label: subjects[1], y: parseFloat(passedarray[1])  },
			{ label: subjects[2], y: parseFloat(passedarray[2])  },
			{ label: subjects[3],  y: parseFloat(passedarray[3]) },
			{ label: subjects[4],  y: parseFloat(passedarray[4])  }
		]
	}
	]
});
chart.render();

}
</script>
</head>
<style>
.center {
	margin: auto;
	width: 50%;
	border: 5px solid white;
	padding: 10px;
}

th{
	background-color: #804ba6;
}
table{
	font-size:0.9em;
}
#back_button{
	margin-left:50em;
}

</style>
<!-- <body>
	<img src="images/print.jpeg" onclick="printFunction()" style="margin-top: 2em;margin-left: 90em; width: 4em ;height: 4em;">
<h1 align="center"><font color="white"> -->
	SUBJECT WISE RESULT ANALYSIS</font></h1>	

<?php 
$flag=0;
error_reporting(E_ERROR | E_PARSE);

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

if (isset($_POST['submit']))
	{
		$br=$_POST['branch'];
		$sem=$_POST['semester'];
		$shft=$_POST['shift'];
		$date=$_POST['e_date'];


	}

	echo '<img src="images/print.jpeg" onclick="printFunction()" style="margin-top: 2em;margin-left: 70%; width: 4em ;height: 4em;">
<h1 align="center"><font color="white">
	SUBJECT WISE RESULT ANALYSIS  ('.$date.') </font></h1>';


	$conn=mysqli_connect("localhost","root", "","project");

	if($conn -> connect_error)
	{
		die("Connection error".$conn -> connect_error);
	}
// $sub_array[6][5];
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
			$br_name="THE DEPARTMENT OF INFORMATION AND TECHNOLOGY ENGINEERING";
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
			$br_name="THE DEPARTMENT OF COMPUTER SCIENCE ENGINEERING";

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
			$br_name="THE DEPARTMENT OF INSTRUMENTATION ENGINEERING";

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
			$br_name="THE DEPARTMENT OF ELECTRONICS AND TELECOMMUNICATION ENGINEERING";

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
			$br_name="THE DEPARTMENT OF ELECTRONICS ENGINEERING";

		}








	function first_two_year($conn1,$br1,$sem1,$shft1,$date1,$sub_array)
	{
		// $graph_array[5];
		global $br_name;
		$initial_check="SELECT S1WMS FROM project where BRANCH='$br1' AND SEMESTER='$sem1' AND SHIFT='$shft1'and NOT S1WMS='ABS' and E_DATE='$date1' ";
	$initial_res=$conn1-> query($initial_check);
	$var1=$initial_res->num_rows;
	if($var1==0 ||$var1==1)
	{
		echo "<h3 style='color:white;' align='center'>NO RESULT FOR THE SELECTED OPTIONS<BR>TRY AGAIN WITH VALID OPTIONS</h3>";
		echo "<a href='html/start.html' id='back_button'><button type='button' class='btn btn-secondary'>Go Back</button></a>";
	}

else
{
	echo "<table border='1' class='center'>";
	echo "<tr><th><h3>Subject</h3></th>";
	echo "<th><h3>Appeared</h3></th>";
	echo "<th><h3>Above 48</h3></th>";
	echo "<th><h3>Btw 32 n 48</h3></th>";
	echo "<th><h3>Pass</h3></th>";
	echo "<th><h3>Fail</h3></th>";
	echo "<th><h3>Percentage</h3></th></tr>";





	$i=0;

	$sub=1;
	while($sub<=5)
	{
		$above_48=0;
		$pass=0;
		$fail=0;
		$bet32_48=0;
		
		
		echo "<tr>";
	 //displaying subject name
		

		if($sub==1)
		echo "<h3 align='center'><font color='white'>$br_name</font></h3><br>";
		$arr_sem=$sem1-3;
		$arr_sub=$sub-1;
		echo "<td>".$sub_array[$arr_sem][$arr_sub]."</td>";

		

		$attribute="S".$sub."WMS";

		$sql1="SELECT $attribute FROM project where BRANCH='$br1' AND SEMESTER='$sem1' AND SHIFT='$shft1'and NOT $attribute='ABS' and E_DATE='$date1' ";
		$res1=$conn1-> query($sql1);

		//res1 is the name of the result of the sql query
		echo "<td>$res1->num_rows</td>";
		//marks above 48
		while ($row=$res1->fetch_assoc()) {
			$cell=$row["$attribute"];
			$marks=0;
			for($i=0;$i<strlen($cell);$i++)
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
		$graph_array[$sub-1]=number_format($pass_percent,2,".","");
		echo "<td>$above_48</td>";
		echo "<td>$bet32_48</td>";
		//no of pass students
		echo "<td>$pass</td>";
		echo "<td>$fail</td><td>";
		printf("%.2f",$pass_percent);

		echo "%</td></tr>";
		$sub++;

	}
	return $graph_array;
}


	}

	function last_year($conn1,$br1,$sem1,$shft1,$date1,$sub_array)
	{
		
		$initial_check="SELECT S1_TH FROM final_year where SEMESTER='$sem1' AND SHIFT='$shft1' and E_DATE='$date1' ";
		$initial_res=$conn1->query($initial_check);
		$var1=$initial_res->num_rows;
		if ($var1==0)
		{
			echo "<h3 style='color:white;' align='center'>NO RESULT FOR THE SELECTED OPTIONS<BR>TRY AGAIN WITH VALID OPTIONS</h3>";
		echo "<a href='html/start.html' id='back_button'><button type='button' class='btn btn-secondary'>Go Back</button></a>";
		}
		else
		{
			echo "<table border='1' class='center'>";
			echo "<tr><th><h3>Subject</h3></th>";
			echo "<th><h3>Appeared</h3></th>";
			echo "<th><h3>Above 48</h3></th>";
			echo "<th><h3>Btw 32 n 48</h3></th>";
			echo "<th><h3>Pass</h3></th>";
			echo "<th><h3>Fail</h3></th>";
			echo "<th><h3>Percentage</h3></th></tr>";
		}




		$i=0;

	$sub=1;
	while($sub<=5)
	{
		$above_48=0;
		$pass=0;
		$fail=0;
		$bet32_48=0;
		
		
		echo "<tr>";
	 //displaying subject name
		

		if($sub==1)
		echo "<h3 align='center'><font color='white'>$br_name</font></h3><br>";
		$arr_sem=$sem1-3;
		$arr_sub=$sub-1;
		echo "<td>".$sub_array[$arr_sem][$arr_sub]."</td>";

		

		$attribute="S".$sub."_TH";

		if($sub==5)
			{$attribute="S".$sub."_TW";}

		$sql1="SELECT $attribute FROM final_year where SEMESTER='$sem1' AND SHIFT='$shft1'and E_DATE='$date1' ";
		$res1=$conn1-> query($sql1);

		//res1 is the name of the result of the sql query
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
}

	if ($sem=="SEMESTER" || $br=="BRANCH" || $shft=="SHIFT" || $date=="EXAM DATE")
	{
		$flag=1;
		echo "<h3 style='color:white;' align='center'>NO RESULT FOR THE SELECTED OPTIONS<BR>TRY AGAIN WITH VALID OPTIONS</h3>";
		echo "<a href='html/start.html' id='back_button'><button type='button' class='btn btn-secondary'>Go Back</button></a>";
	}

	if(($sem=="3" || $sem=="4" || $sem=="5" || $sem=="6") && $flag==0)
	{
		// $graph_array1[5];
		$graph_array1= first_two_year($conn,$br,$sem,$shft,$date,$sub_array);
	
	}

	else if (($sem=="7" || $sem=="8") && $flag==0)
	{
		last_year($conn,$br,$sem,$shft,$date,$sub_array);
	}




?>

</table>
<br><br><br>
<button class="btn btn-primary set2" type="submit" onclick="myGraph()" style="margin-left:50%;">Get Graph</button>
<div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>
<div style="margin-top:8px;">
<div style="float:left;">
<h3 style="color:white; margin-left:2em">
RESULT ANALYSIS CO-ORDINATOR
</h3>
</div>
<div style="float:right;">
<h3 style="color:white; margin-right:2em">
HEAD OF DEPARTMENT
</h3>
</div>
</div>
</body>
<script>
	function printFunction() {

		window.print();

	}


	var all_sem_subject=<?php  echo json_encode($sub_array); ?>;
	var sem=<?php echo json_encode($sem); ?>;
	var subjects=all_sem_subject[sem-3]

	var passedarray=<?php echo json_encode($graph_array1); ?>;
	for(var i=0;i<passedarray.length;i++)
	{
		
	}

	</script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js">
	</script>




</body>
</html>
