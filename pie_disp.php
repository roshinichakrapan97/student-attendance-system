<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   
 <head>
<link href="master.css" rel="stylesheet">
<link href="share.css" rel="stylesheet">
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Pie Chart Demo (Google VAPI) - http://codeofaninja.com/</title>


</head>
<body bgcolor="white">
<header>
<h1>
ATTENDANCE PIE CHART</h1>
</header>
<nav>
<a href="college.html"> ADMIN PAGE </a><br>
<a href="attendance.html"> ATTENDANCE</a><br>
<a href="timetable.php">TIMETABLE</a>
<br>
<a href="defaulter.html">DEFAULTERS LIST</a><br>
<br><br><br><br><br>
<a href="pie1.html"> <-- BACK</a><br>
</nav>    
<body style="font-family: Arial;border: 0 none;">
    <!-- where the chart will be rendered -->
<center>
    <div id="visualization" style="width: 600px; height: 400px;"></div>
 </center>
    <?php
 $link=mysqli_connect("localhost","root","","srp");
if($link==false)
 die("ERROR:could not connect".mysqli_connect_error());
$psub = $_POST['subj'];
$ppin = $_POST['pin'];

$sql="delete from pie_count where 1";
mysqli_query($link,$sql);

$pcount=0;
$sql2="select count(*) from attendance_details where a_pin=".$ppin." and a_sub='".$psub."'";
if($result2=mysqli_query($link,$sql2))
{
if(mysqli_num_rows($result2)>0)
{
while($row2=mysqli_fetch_array($result2))
{
$pcount=$row2['count(*)'];
$sql3="insert into pie_count(pie_pin,pie_sub,pie_count,pie_text) values('$ppin','$psub',$pcount,'Attended')";
mysqli_query($link,$sql3);
}}
}
 
$sql4 = "select count(*) from period_details where p_sub='".$psub."'";
if($result4=mysqli_query($link,$sql4))
{
if(mysqli_num_rows($result4)>0)
{
while($row4=mysqli_fetch_array($result4))
{
$maxcount=$row4['count(*)'];
$notatt=$maxcount-$pcount;
$sql5="insert into pie_count(pie_pin,pie_sub,pie_count,pie_text) values('$ppin','$psub',$notatt,'Not Attended')";
mysqli_query($link,$sql5);

}}}

    //query all records from the database
    $query = "select * from pie_count";
 
    //execute the query
    $result = mysqli_query($link,$query);
 
    //get number of rows returned
    $num_results = mysqli_num_rows($result);
 
    if( $num_results > 0){
 
    ?>
        <!-- load api -->
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        
        <script type="text/javascript">
            //load package
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
 
        <script type="text/javascript">
            function drawVisualization() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['pie_text', 'count'],
                    <?php
                    while( $row = $result->fetch_assoc() ){
                        extract($row);
                        echo "['{$pie_text}', {$pie_count}],";
                    }
                    ?>
                ]);
 
                // Create and draw the visualization.
                new google.visualization.PieChart(document.getElementById('visualization')).
                draw(data, {title:"ATTENDANCE PIE CHART"});

            }
 
            google.setOnLoadCallback(drawVisualization);
        </script>
    <?php
 
    }else{
        echo "No programming languages found in the database.";
    }
    ?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<form action="logout.php">
<input type ="submit" name="logout" value="LOGOUT" style="float:right;">
</form>
</body>
</html>
