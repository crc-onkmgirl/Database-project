<?php session_start();?>
<?php
$sid = $_SESSION['sid'];
$jid = $_GET['jid'];
$pushdate = $_GET['pushdate'];

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

$ignorePushJob =  mysql_query("update PushJob set status = 'checked' where sid = '$sid' and jid = '$jid' and pushdate = '$pushdate';");

if ($ignorePushJob) {
	echo "Pushed Job Ignored Successfully!";
}

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>