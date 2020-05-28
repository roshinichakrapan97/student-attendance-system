<html>
<head>
<link href="master.css" rel="stylesheet">
<link href="share.css" rel="stylesheet">
</head>
<body bgcolor="white">
<header>
<h1>
TIMETABLE</h1>
</header>
<nav>
<a href="college.html"> ADMIN PAGE </a><br>

<a href="attendance.html">ATTENDANCE</a><br>
<a href="pie1.html"> ATTENDANCE CHART</a><br>
<a href="defaulter.html"> DEFAULTER LIST</a><br>
<a href="timetable.php"> TIMETABLE</a><br>
</nav>
<br><br>

<?php
$link=mysqli_connect("localhost","root","","srp");
if($link==false)
 die("ERROR:could not connect".mysqli_connect_error());

echo"<center>";



$sql1= "select t_day,t_sub,t_hr from timetable where t_day='Monday' order by t_hr ASC";

echo"<center>";
if($result1=mysqli_query($link,$sql1))
{
echo"<table border='1'>";
echo "<tr>";
echo "<th> DAY </th>";
echo "<th> 1 </th>";
echo "<th>2 </th>";
echo "<th> 3 </th>";
echo "<th>4 </th>";
echo "<th> 5 </th>";
echo "<th>6 </th>";
echo "<th> 7 </th>";
echo "<th>8 </th>";

echo "</tr>";echo "<tr>";
echo"<td>Monday</td>";

if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{


echo "<td> ".$row1['t_sub']." </td>";


}
}
echo "</tr>";


}


$sql2= "select t_day,t_sub,t_hr from timetable where t_day='Tuesday' order by t_hr ASC";

echo"<center>";
if($result1=mysqli_query($link,$sql2))
{


echo "</tr>";echo "<tr>";
echo"<td>Tuesday</td>";

if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{
echo "<td> ".$row1['t_sub']." </td>";
}
}
echo "</tr>";
}
$sql3= "select t_day,t_sub,t_hr from timetable where t_day='Wednesday' order by t_hr ASC";

echo"<center>";
if($result1=mysqli_query($link,$sql3))
{


echo "</tr>";echo "<tr>";
echo"<td>Wednesday</td>";

if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{
echo "<td> ".$row1['t_sub']." </td>";
}
}
echo "</tr>";
}
$sql2= "select t_day,t_sub,t_hr from timetable where t_day='Thursday' order by t_hr ASC";

echo"<center>";
if($result1=mysqli_query($link,$sql2))
{


echo "</tr>";echo "<tr>";
echo"<td>Thursday</td>";

if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{
echo "<td> ".$row1['t_sub']." </td>";
}
}
echo "</tr>";
}



$sql2= "select t_day,t_sub,t_hr from timetable where t_day='Friday' order by t_hr ASC";

echo"<center>";
if($result1=mysqli_query($link,$sql2))
{


echo "</tr>";echo "<tr>";
echo"<td>Friday</td>";

if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{
echo "<td> ".$row1['t_sub']." </td>";
}
}
echo "</tr>";
}

else
 echo "ERROR: ".mysqli_error($link);
echo"</table>";
echo"</center>";
mysqli_close($link);
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<form action="logout.php">
<input type ="submit" name="logout" value="LOGOUT" style="float:right;">
</form>
</body>
</html>