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
</body>
</html>