<html>
<head>
<link href="master.css" rel="stylesheet">
<link href="share.css" rel="stylesheet">
</head>
<body bgcolor="white">
<header>
<h1>
TIME TABLE</h1>
</header>
<nav>
<a href="college.html"> ADMIN PAGE </a><br>
<a href="attendance.html"> ATTENDANCE</a><br>
<a href="pie1.html"> ATTENDANCE CHART</a><br>
<a href="defaulter.html">DEFAULTER LIST</a><br>
</nav>

<br><br>
<form action="add_entry.php" name="myForm" method="POST" onsubmit="return (validate());">

<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="subj"> SELECT DAY:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
<select name="day">
	<option value="Monday">Monday</option>
	<option value="Tuesday">Tuesday</option>
	<option value="Wednesday">Wednesday</option>
	<option value="Thursday">Thursday</option>
	<option value="Friday">Friday</option>
</select>	
</p>

<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="subj"> SELECT SUBJECT:&nbsp&nbsp&nbsp&nbsp&nbsp</label>
<select name="subj">
	<option value="CN">CN</option>
	<option value="GM">GM</option>
	<option value="OOAD">OOAD</option>
	<option value="DS">DS</option>
	<option value="DIP">DIP</option>
	<option value="IP">IP</option>
<option value="CN_LAB">CN_LAB</option>
	<option value="GM_LAB">GM_LAB</option>
<option value="SRP">SRP</option>
	<option value="LIB">LIB</option>

</select>	
</p>

<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="subj"> SELECT HOUR:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
<select name="hour">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
</select>	
</p>

&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" name="ADD" value="ADD ENTRY" id="add">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="submit" name="UPDATE" value="UPDATE">
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="submit" name="SHOW" value="SHOW TIMETABLE">
</p>
</form>
<br><br><br><br><br><br><br><br><br><br>
<form action="timetable.php" name="import" method="POST" enctype="multipart/form-data">
<input type="file" name="file" /><br />
<input type="SUBMIT" name="SUBMIT" value="SUBMIT"/>
</form>
<?php

$link=mysqli_connect("localhost","root","","srp");
if($link==false)
{
die("ERROR:could not connect.".mysqli_connect_error());
}
if(isset($_POST["SUBMIT"]))
{
$file = $_FILES['file']['tmp_name'];
$handle = fopen($file, "r");
$c = 0;
$sql3="delete from timetable";
mysqli_query($link,$sql3);
while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
{
$day= $filesop[0];
$sub= $filesop[1];
$hr= $filesop[2];

$sql4="insert into timetable (t_day,t_sub,t_hr) VALUES ('$day','$sub','$hr')";

mysqli_query($link,$sql4);
$c = $c + 1;
//header('Location:timetable.php');
}
header('Location:timetable.php');
}
?>
<br><br><br><br><br><br><br>
<form action="logout.php">
<input type ="submit" name="logout" value="LOGOUT" style="float:right;">
</form>
</body>
</html>