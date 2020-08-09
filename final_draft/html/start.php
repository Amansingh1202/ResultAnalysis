<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/stylesheet1.css" rel="stylesheet">
    <script src="jquery-1.4.4.min.js"></script>
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
        echo "$username $sdrn";
    }
}


?>





<div class="container-fluid form-group" id="semesterWise">
    <form action="/ResultAnalysis/final_draft/display.php" action="start.php" id='ResultForm' method="post">
        <h1 align="center">Subject Wise Result Analysis</h1>
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <label for="branch">BRANCH</label>
                <select class="form-control" id="branch" name="branch">
                    <option selected value="BRANCH">BRANCH</option>
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
                    <option selected value="SEMESTER">SEMESTER</option>
                    <option value="3">Sem III</option>
                    <option value="4">Sem IV</option>
                    <option value="5">Sem V</option>
                    <option value="6">Sem VI</option>
                    <option value="7">Sem VII</option>
                    <option value="8">Sem VIII</option>

                </select><br>
            </div>
            <div class="col-lg-2 col-md-2">
                <label for="shift">SHIFT</label>
                <select class="form-control" id="shift" name="shift">
                    <option selected value="SHIFT">SHIFT</option>
                </select><br>
            </div>


            <div class="col-lg-2 col-md-2">
                <label for="FormSelect4">EXAM DATE</label>
                <select class="form-control" id="FormSelect4" name="e_date">
                    <option selected value="EXAM DATE">EXAM DATE</option>
                    <option value="MAY-18">MAY-2018</option>
                    <option value="NOV-17">NOVEMBER-2017</option>
                    <option value="NOV-19">NOVEMBER-2019</option>
                </select><br>
            </div>
            <div class="col-lg-2 col-md-2 group1">
                <button class="btn btn-primary" name="submit" type="submit">Get Values</button>
                <!-- <button class="btn btn-primary" name="submit_graph1" type="submit">Get Graph</button> -->
            </div>
        </div>

    </form>
    <br>


    <form action="/ResultAnalysis/final_draft/clsdisplay.php" method="post">
        <h1 align="center">Class Wise Result Analysis</h1>
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <label for="FormSelect1">BRANCH</label>
                <select class="form-control" id="FormSelect1" name="branch">
                    <option selected value="BRANCH">BRANCH</option>
                    <option value="C">Computer Science</option>
                    <option value="T">Information n Technology</option>
                    <option value="X">Elec n Telecomm</option>
                    <option value="E">Electronics</option>
                    <option value="I">Instrumentaion</option>
                </select><br>
            </div>


            <div class="col-lg-2 col-md-2">
                <label for="FormSelect4">EXAM DATE</label>
                <select class="form-control" id="FormSelect4" name="e_date">
                    <option selected value="EXAM DATE">EXAM DATE</option>
                    <option value="MAY-18">MAY-2018</option>
                    <option value="NOV-17">NOVEMBER-2017</option>
                </select><br>
            </div>
            <div class="col-lg-2 col-md-2 group2">
                <button class="btn btn-primary set2" name="submit" type="submit">Get Values</button>
            </div>
        </div>

    </form>

    <form action="/ResultAnalysis/final_draft/topper.php" method="post">
        <h1 align="center">Toppers List</h1>
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <label for="FormSelect1">BRANCH</label>
                <select class="form-control" id="FormSelect1" name="branch">
                    <option selected value="BRANCH">BRANCH</option>
                    <option value="C">Computer Science</option>
                    <option value="T">Information n Technology</option>
                    <option value="X">Elec n Telecomm</option>
                    <option value="E">Electronics</option>
                    <option value="I">Instrumentaion</option>
                </select><br>
            </div>


            <div class="col-lg-2 col-md-2">
                <label for="FormSelect4">EXAM DATE</label>
                <select class="form-control" id="FormSelect4" name="e_date">
                    <option selected value="EXAM DATE">EXAM DATE</option>
                    <option value="MAY-18">MAY-2018</option>
                    <option value="NOV-17">NOVEMBER-2017</option>
                </select><br>
            </div>
            <div class="col-lg-2 col-md-2 group2">
                <button class="btn btn-primary set2" name="topper_submit" type="submit">Get Values</button>
            </div>
        </div>

    </form>



</div>
</body>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {
        var T = [
            {display: "First Shift", value: "1"},
        ];

        var C = [
            {display: "First Shift", value: "1"},
            {display: "Second Shift", value: "2"},
        ];

        var X = [
            {display: "First Shift", value: "1"},
            {display: "Second Shift", value: "2"},
        ];
        var E = [
            {display: "First Shift", value: "1"},
            {display: "Second Shift", value: "2"},
        ];
        var I = [
            {display: "First Shift", value: "1"},

        ];

        $("#branch").change(function () {
            var parent = $(this).val();

            switch (parent) {
                case 'T':
                    list(T);
                    break;
                case 'C':
                    list(C);
                    break;
                case 'X':
                    list(X);
                    break;
                case 'E':
                    list(E);
                    break;
                case 'I':
                    list(I);
                    break;
                default:
                    $("#shift").html('');
                    break;
            }
        });

        function list(array_list) {
            $("#shift").html("");
            $(array_list).each(function (i) {
                $("#shift").append("<option value=\"" + array_list[i].value + "\">" + array_list[i].display + "</option>");
            });
        }

    });


</script>
</html>
