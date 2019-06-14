<?php session_start();?>
<?php
$sid = $_SESSION['sid'];
$jid = $_GET['jid'];
$pushdate = $_GET['pushdate'];
date_default_timezone_set('America/New_York'); 
$applydate = date('Y-m-d H:i:s');

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

$applyjob = mysql_query("INSERT INTO Apply (sid,jid,applydate,status) VALUES ('$sid','$jid','$applydate','unchecked');");
$checked =  mysql_query("update PushJob set status = 'checked' where sid = '$sid' and jid = '$jid' and pushdate = '$pushdate';");
if ($applyjob && $checked) {
	echo "Successfully Applied!<br>";
}
echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";


?>