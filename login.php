<?php session_start() ?>
<?php
if(isset($_SESSION["user"])=="admin")
{
	echo "<script>document.location.href='college.html';</script>";
}
if(isset($_SESSION["user"])=="student")
{
	echo "<script>document.location.href='s_attendance.html';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/dthpro/bootstrap.min.css">
  <script src="/dthpro/bootstrap.min.js"></script>
<style>
header{display:block;background-color:black;width:100%;padding:0.1em;}
header h1{font-family:cooper;color:white;line-height:10px;color:white;margin-left:5%;}
small{font-family:arial;color:grey;}
body{margin:0em;background-image:url('mit.jpg');background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
background-color: black; }
table{width:25%;margin-left:37.5%;margin-right:37.5%;margin-top:15%;}
td {padding-bottom:1em;text-align:right;}
td.lab{text-align:center;color:yellow;}
td.err{text-align:left;color:red;}
</style>
</head>
<body>
<?php $loginerr= $user = $pwd = "" ?>
<?php 
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$user=$_POST['l_user'];
	$pwd=$_POST['l_pwd'];
$link=mysqli_connect("localhost","root","","srp");
if($link==false)
	die("ERROR: Could not connect".mysqli_connect_error());
$sql="select l_pwd from login where l_user='".$_POST['l_user']."'";
if($result=mysqli_query($link,$sql))
{
	if(mysqli_num_rows($result)==0)
		$loginerr="No such user found";
	else
	{
		$passwd=mysqli_fetch_array($result);
		if($_POST['l_pwd'] != $passwd['l_pwd'])
			$loginerr="Username or password is incorrect";
		else
		{   $_SESSION["user"]=$_POST['l_user'];
if($_POST['l_user']=="admin")
{
		echo "<script>document.location.href='college.html';</script>";
}
if($_POST['l_user']=="student")
{
		echo "<script>document.location.href='s_attendance.html';</script>";
}
 }
	}	
}
mysqli_close($link);
}
?>
<header>
<h1>MADRAS INSTITUTE OF TECHNOLOGY</h1>
<h1><small>ATTENDANCE RECORDS</small></h1>
</header>
<form name="login" action='<?php echo $_SERVER['PHP_SELF'] ?>' method="POST" role="form">
<table>
<tr><div class="form-group"><td class="lab"><label for="usr"><b>User ID: </b></label></td><td><input type="text" name="l_user" value='<?php echo $user ?>' id="usr" placeholder="Enter the User ID" class="form-control"></td></div></tr>
<tr><div class="form-group"><td class="lab"><label for="pwd"><b>Password: </b></label></td><td><input type="password" name="l_pwd" value='<?php echo $pwd ?>' id="pwd" placeholder="Enter the password" class="form-control"></td></div></tr>

<tr><td class="lab">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-primary" >Login</button></td><td class="err"><?php echo $loginerr ?></td></tr></table>
</form>
</body>
</html>

