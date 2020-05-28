<!doctype html>
<html>
<head>
<link href="master.css" rel="stylesheet">
<link href="share.css" rel="stylesheet">
</head>
<body bgcolor="white">
<header><center><h1>MARK ATTENDANCE</h1></center></header>
<nav>

<a href="s_attendance.html"> ATTENDANCE</a><br>
<a href="s_show.php">SHOW TIMETABLE</a><br>
<a href="s_pie1.html"> ATTENDANCE CHART</a><br>
<a href="s_defaulter.html">DEFAULTERS LIST</a><br>
</nav><br>
<center>
<body>

<?php
$date= date("Y-m-d");
$day= date("l");
$time=date("H:i:s");

$p11="08:30:00";
$p12="09:20:00";
$p21="09:20:00";
$p22="10:10:00";
$p31="10:30:00";
$p32="11:20:00";
$p41="11:20:00";
$p42="12:10:00";
$p51="13:10:00";
$p52="14:00:00";
$p61="14:00:00";
$p62="14:50:00";
$p71="14:50:00";
$p72="15:40:00";
$p81="15:40:00";
$p82="16:30:00";

if($time>$p11 && $time<$p12)
$pno=1;

if($time>$p21 && $time<$p22)
$pno=2;

if($time>$p31 && $time<$p32)
$pno=3;

if($time>$p41 && $time<$p42)
$pno=4;

if($time>$p51 && $time<$p52)
$pno=5;

if($time>$p61 && $time<$p62)
$pno=6;

if($time>$p71 && $time<$p72)
$pno=7;

if($time>$p81 && $time<$p82)
$pno=8;


$link1=mysqli_connect("localhost","root","","srp");
if($link1==false)
{
die("ERROR:could not connect.".mysqli_connect_error());
}



$sql1="select t_sub from timetable where t_day='".$day."' and t_hr= '".$pno."'";
if($result1=mysqli_query($link1,$sql1))
{
if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{
$psub=$row1['t_sub'];
}}}


if($_POST['NEXT']=='NEXT')
{
$sql="insert into period_details(p_date,p_day,p_hr,p_sub)values('$date','$day','$pno','$psub')";
if(mysqli_query($link1,$sql))
{
header('Location:scan.html');
}
else
{
echo "ERROR:could not able to execute $sql.".mysqli_error($link);
}
}

$sql2="insert into temp2 select distinct * from period_details";
$sql3="delete from period_details";
$sql4="insert into period_details select * from temp2";
$sql5="delete from temp2";



mysqli_query($link1,$sql2);
mysqli_query($link1,$sql3);
mysqli_query($link1,$sql4);
mysqli_query($link1,$sql5);

mysqli_close($link1);
?>


</center>
?>
