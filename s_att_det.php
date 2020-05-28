<html>
<head>
<link href="master.css" rel="stylesheet">
<link href="share.css" rel="stylesheet">
</head>
<body bgcolor="white">
<header>
<h1>
ATTENDANCE DETAILS</h1>
</header>
<nav>


<a href="s_pie1.html"> ATTENDANCE CHART</a><br>
<a href="s_show.php"> SHOW TIMETABLE</a><br>
<a href="s_defaulter.html">DEFAULTERS LIST</a><br>
<a href="mark.php"> MARK ATTENDANCE</a>
<br><br><br><br><br><br><br>
<a href="s_attendance.html"> <- BACK</a><br>
</nav>
<br><br>

<?php
$link=mysqli_connect("localhost","root","","srp");
if($link==false)
 die("ERROR:could not connect".mysqli_connect_error());

echo"<center>";
$spin = $_POST['number'];
$sdate = $_POST['date'];


$sql1= "select a_date,a_pin,a_hr,a_sub from attendance_details where a_date='".$sdate."' and a_pin='".$spin."'";

echo"<center>";
if($result1=mysqli_query($link,$sql1))
{
echo"<table border='1'>";
echo "<tr>";
echo "<th> DATE </th>";
echo "<th> STUDENT PIN </th>";
echo "<th> PERIOD </th>";
echo "<th> SUBJECT </th>";
echo "</tr>";
if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{

echo "<tr>";
echo "<td> ".$row1['a_date']." </td>";
echo "<td> ".$row1['a_pin']."  </td>";
echo "<td> ".$row1['a_hr']."  </td>";
echo "<td> ".$row1['a_sub']."  </td>";
echo "</tr>";
}
}else 
{
echo"The student id ".$spin."has not attended any class";
}
echo"</table>";

}
else
 echo "ERROR: ".mysqli_error($link);
echo"</center>";
mysqli_close($link);
?>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<form action="logout.php">
<input type ="submit" name="logout" value="LOGOUT" style="float:right;">
</form>
</body>
</html>