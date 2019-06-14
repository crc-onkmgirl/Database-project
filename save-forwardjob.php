<?php session_start();?>
<?php
$fromsid = $_SESSION['sid'];
$tosid = $_SESSION['fwJobToSid'];
$jid = $_GET['jid'];
date_default_timezone_set('America/New_York'); 
$forwarddate = date('Y-m-d H:i:s');

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

$saveFwJob = mysql_query("INSERT INTO ForwardJob (fromsid,tosid,jid,forwarddate,status) VALUES ('$fromsid','$tosid','$jid','$forwarddate', 'unchecked');");
if ($saveFwJob) {
	echo "Successfully Forward!<br>";
}

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>