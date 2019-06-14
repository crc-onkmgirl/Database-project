<?php
$fromsid = $_GET['fromsid'];
$tosid = $_GET['tosid'];
$jid = $_GET['jid'];
$forwarddate = $_GET['forwarddate'];

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

$ignoreForwardJob =  mysql_query("update ForwardJob set status = 'checked' where fromsid = '$fromsid' and tosid = '$tosid' and jid = '$jid' and forwarddate = '$forwarddate';");

if ($ignoreForwardJob) {
	echo "Forward Job Ignored Successfully!";
}

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>