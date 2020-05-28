<!doctype html>
<html>
<body>

<?php
require 'PHPMailerAutoload.php';
$link=mysqli_connect("localhost","root","","srp");
if($link==false)
{
die("ERROR:could not connect.".mysqli_connect_error());
}
$sql1="select d_name,d_sub from defaulter";
if($result1=mysqli_query($link,$sql1))
{
if(mysqli_num_rows($result1)>0)
{
while($row1=mysqli_fetch_array($result1))
{
$cpin=$row1['d_name'];
$csub=$row1['d_sub'];

$sql2="select s_mail,s_name,s_pin from student where s_pin=".$cpin."";
if($result2=mysqli_query($link,$sql2))
{
if(mysqli_num_rows($result2)>0)
{
while($row2=mysqli_fetch_array($result2))
{
$to_id=$row2['s_mail'];
$name=$row2['s_name'];
$ppin=$row2['s_pin'];


$email="vaidhehi.vasudevan@gmail.com";
$password="bluebird97";
$subject="Regarding Student Attendance";
$message="Hello Sir/Madam,<br>\n\t\t Your ward ".$name." (".$ppin.") has not attended the ".$csub." classes regularly. Your ward's attendance percentage is below 75%. If your ward's attendance is below 75% at the end of the year, they will not be permitted to attend the final exams. So kindly make sure that they attend the classes regularly.<br>Thank you. ";

try{
$mail = new PHPMailer(true);
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
$mail->FromName ="Madras Institute Of Technology";
//$mail->setFrom($result["emailfrom"], $result["emailfrom"]);
if (!$mail->send()) {
$error = "Mailer Error: " . $mail->ErrorInfo;
echo '<p id="para">'.$error.'</p>';
}
else {
header('Location:defaulter.html');
}
}
 catch (phpmailerException $e) {
  echo $e->getMessage();

}
}}}
}}}


?>
</body>
</html>
