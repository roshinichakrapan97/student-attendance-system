<!doctype html>
<html>
<head>
<link href="master.css" rel="stylesheet">
<link href="share.css" rel="stylesheet">
</head>
<body bgcolor="white">
<header><center><h1>MADRAS INSTITUTE OF TECHNOLOGY</h1></center></header>
<nav>

<a href="college.html"> ADMIN PAGE</a><br>
<a href="attendance.html"> ATTENDANCE</a><br>
<a href="defaulter.html"> DEFAULTER LIST</a><br>

</nav><br>
<center>
<?php
$link=mysqli_connect("localhost","root","","srp");
if($link==false)
{
die("ERROR:could not connect.".mysqli_connect_error());
}
$tday=$_POST['day'];
$tsub=$_POST['subj'];
$thr=$_POST['hour'];

if($_POST['ADD']=='ADD')
{
$sql="insert into timetable(t_day,t_sub,t_hr)values('$tday','$tsub','$thr')";
if(mysqli_query($link,$sql))
{
header('Location:timetable.php');
}
else
{
echo "ERROR:could not able to execute $sql.".mysqli_error($link);
}
}
else if($_POST['UPDATE']=='UPDATE')
{
$sql1="update timetable set t_sub= '".$tsub."' where t_day='".$tday."' and t_hr=".$thr."";
if(mysqli_query($link,$sql1))
{
header('Location:timetable.php');
}
else
{
echo "ERROR:could not able to execute $sql.".mysqli_error($link);
}
}
else if($_POST['SHOW']=='SHOW TIMETABLE')
{
header('Location:show.php');
}


else
{
header('Location:timetable.php');
}

mysqli_close($link);
?>
</body>
</html>