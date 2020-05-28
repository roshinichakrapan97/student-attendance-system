<html>
<head>
<link href="master.css" rel="stylesheet">
<link href="share.css" rel="stylesheet">
<meta charset="UTF-8">
<title>Send email via Gmail SMTP server in PHP</title>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<meta name="robots" content="noindex, nofollow">
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-43981329-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script');
ga.type = 'text/javascript';
ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
})();
</script>
</head>
<header>
<h1>
REPORT</h1>
</header>
<nav>
<a href="college.html"> ADMIN PAGE </a><br>


<a href="attendance.html"> ATTENDANCE</a><br>
<a href="pie1.html"> ATTENDANCE CHART</a><br>
<a href="timetable.html">TIMETABLE</a>
<br><br><br><br><br><br><br>
<a href="defaulter.html"> <- BACK</a><br>
</nav>
<br><br>
<body>
<?php
require 'PHPMailerAutoload.php';
$link=mysqli_connect("localhost","root","","srp");
if($link==false)
 die("ERROR:could not connect".mysqli_connect_error());
$email="roshinivcp@gmail.com";
$password="Rose1997";
$message="Your son/daughter is irregular to the class.Hence his/her name is in the defaulters list.Kindly take concern in your child's irregularity";
$subject="MIT - DEFAUTERS LIST INFORMATION ";
$sql1="select c_name,c_sub from count_table";
if($result1=mysqli_query($link,$sql1))
{
if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{ 
$stud=$row1['c_name'];
$subj=$row1['c_sub'];

$sql2="select s_name,s_mail,s_pin from student where s_pin='".$stud."'";
if($result2=mysqli_query($link,$sql2))
{
if(mysqli_num_rows($result2)>0)
{
while($row2=mysqli_fetch_array($result2))
{
$sname=$row2['s_name'];
$message="Your son/daughter ".$sname." is irregular to the class.Hence ".$sname."'s  name is in the defaulters list.Kindly take concern in your child's irregularity"; 
$to_id=$row2['s_mail'];
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = $email;
$mail->Password = $password;
$mail->addAddress($to_id);
$mail->Subject = $subject;
$mail->msgHTML($message);
if (!$mail->send()) {
$error = "Mailer Error: " . $mail->ErrorInfo;
echo '<p id="para">'.$error.'</p>';
}
else {
header('Location:defaulter.html');
echo '<p id="para">Message sent!</p>';
}
}}}
}}}
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<form action="logout.php">
<input type ="submit" name="logout" value="LOGOUT" style="float:right;">
</form>
</body></html>




