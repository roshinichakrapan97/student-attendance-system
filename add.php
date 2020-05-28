<!doctype html>
<html>
<body>
<?php
$link=mysqli_connect("localhost","root","","srp");
if($link==false)
{
die("ERROR:could not connect.".mysqli_connect_error());
}
$sno=$_POST['number'];
$name=$_POST['name'];
$pin=$_POST['pin'];
$dep=$_POST['department'];
$mail=$_POST['email'];
if($_POST['ADD']=='ADD')
{
$sql="insert into student(s_no,s_name,s_pin,s_dep,s_mail)values('$sno','$name','$pin','$dep','$mail')";
if(mysqli_query($link,$sql))
{
header('Location:college.html');
}
else
{
echo "ERROR:could not able to execute $sql.".mysqli_error($link);
}
}
else if($_POST['UPDATE']=='UPDATE')
{
$sql1="update student set s_name='$name',s_dep='$dep',s_mail='$mail' where s_pin='$pin'";
if(mysqli_query($link,$sql1))
{
header('Location:college.html');
}
else
{
echo "ERROR:could not able to execute $sql.".mysqli_error($link);
}
}
else
{
header('Location:college.html');
}

$sql2="insert into temp4 select distinct * from student";
$sql3="delete from student";
$sql4="insert into student select * from temp4";
$sql5="delete from temp4";
mysqli_query($link,$sql2);
mysqli_query($link,$sql3);
mysqli_query($link,$sql4);
mysqli_query($link,$sql5);
mysqli_close($link);
?>
</body>
</html>