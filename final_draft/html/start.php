<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/stylesheet1.css">
</head>
<body>
<div class="container-fluid form-group" id="semesterWise">
<form action="/ResultAnalysis/final_draft/display.php" action="start.php" method="post">
		<h1 align="center">Subject Wise Result Analysis</h1>
	<div class="row">
	<div class="col-lg-2 col-md-2">
		<label for="FormSelect1">BRANCH</label>
		<select class="form-control" id="FormSelect1" name="branch">
		<option value="BRANCH" selected>BRANCH</option>
		<option value="C">Computer Science</option>
		<option value="T">Information n Technology</option>
		<option value="X">Elec n Telecomm</option>
		<option value="E">Electronics</option>
		<option value="I">Instrumentaion</option>
		</select><br>
	</div>
	<div class="col-lg-2 col-md-2">
		<label for="FormSelect2">SEMESTER</label>
	<select class="form-control" id="FormSelect2" name="semester">
		<option value="SEMESTER" selected>SEMESTER</option>
		<option value="3">Sem III</option>
		<option value="4">Sem IV</option>
		<option value="5">Sem V</option>
		<option value="6">Sem VI</option>

	</select><br>
	</div>
	<div class="col-lg-2 col-md-2">
		<label for="FormSelect3">SHIFT</label>
	<select class="form-control" id="FormSelect3" name="shift">
		<option value="SHIFT" selected>SHIFT</option>
		<option value="1">First Shift</option>
		
		<?php 
		$var=$_POST['branch'];
		if($var!='T' || $var!='I')
		echo "<option value='2'>Second Shift</option>";

		?>

		
			</select><br>
	</div>
		


<div class="col-lg-2 col-md-2">
		<label for="FormSelect4">EXAM DATE</label>
	<select class="form-control" id="FormSelect4" name="e_date">
		<option value="EXAM DATE" selected>EXAM DATE</option>
		<option value="MAY-18">MAY-2018</option>
		<option value="NOV-17">NOVEMBER-2017</option>
	</select><br>
	</div>
		<div class="col-lg-2 col-md-2">
			<button type="submit" name="submit" class="btn btn-primary">Get Values</button>
		</div>
	</div>

</form>
</div>
</body>
</html>
