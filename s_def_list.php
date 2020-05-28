<html>
<head>
<link href="master.css" rel="stylesheet">
<link href="share.css" rel="stylesheet">
</head>
<body bgcolor="white">
<header>
<h1>
DEFAULTER LIST</h1>
</header>
<nav>

<a href="s_attendance.html"> ATTENDANCE</a><br>
<a href="s_pie1.html"> ATTENDANCE CHART</a><br>
<a href="s_show.php"> TIMETABLE</a><br>
<a href="mark.php"> MARK ATTENDANCE</a>
<br><br><br><br><br><br><br>
<a href="s_defaulter.html"> <-- BACK</a><br>
</nav>
<br><br>
<?php
$link=mysqli_connect("localhost","root","","srp");
if($link==false)
 die("ERROR:could not connect".mysqli_connect_error());

echo"<center>";
$dsub = $_POST['subj'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$sql="delete from count_table where 1";
mysqli_query($link,$sql);

$sql1="select s_pin from student";
if($result1=mysqli_query($link,$sql1))
{
if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{
$cpin=$row1['s_pin'];
$sql2="select count(*) from attendance_details where a_pin=".$cpin." and a_sub='".$dsub."' and a_date between '".$fromdate."' and '".$todate."'";
if($result2=mysqli_query($link,$sql2))
{
if(mysqli_num_rows($result2)>0)
{
while($row2=mysqli_fetch_array($result2))
{
$ccount=$row2['count(*)'];
$sql3="insert into count_table(c_name,c_count,c_sub) values('$cpin',$ccount,'$dsub')";
mysqli_query($link,$sql3);
}}
}}}

}
$sql4 = "select count(*) from period_details where p_sub='".$dsub."' and p_date between '".$fromdate."' and '".$todate."'";
if($result4=mysqli_query($link,$sql4))
{
if(mysqli_num_rows($result4)>0)
{
while($row4=mysqli_fetch_array($result4))
{
$pcount=$row4['count(*)'];
$maxcount= $pcount*3/4;
} }

$sql5 = "select c.c_name,c.c_count,c.c_sub,s.s_name,s.s_pin from count_table c inner join student s on c.c_name=s.s_pin where c.c_count<".$maxcount."";

if($result5=mysqli_query($link,$sql5))
{
if(mysqli_num_rows($result5)>0)
{
echo"<table border='1'>";
echo "<tr>";
echo "<th> PIN </th>";
echo "<th> NAME </th>";
echo "<th> SUBJECT </th>";
echo "<th> COUNT </th>";
echo "<th> TOTAL COUNT</th>";
echo"</tr>";
while($row5=mysqli_fetch_array($result5))
{
echo"<tr>";
echo "<td>".$row5['c_name']."</td>";
echo "<td>".$row5['s_name']."</td>";
echo "<td>".$dsub."</td>";
echo "<td>".$row5['c_count']."</td>";
echo "<td>".$pcount."</td>";
echo"</tr>";
}
echo"</table>";
}
else
echo"NO DEFAULTERS FOR THE SUBJECT ".$dsub." BETWEEN ".$fromdate." AND ".$todate.".";



}


}


echo"</center>";



mysqli_close($link);
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<form action="logout.php">
<input type ="submit" name="logout" value="LOGOUT" style="float:right;">
</form>
</body>
</html>