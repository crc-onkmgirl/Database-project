<?php session_start();?>
<?php 
$fromsid = $_GET['fromsid'];
$tosid = $_GET['tosid'];
$requestdate = $_GET['requestdate'];
date_default_timezone_set('America/New_York'); 
$replydate = date('Y-m-d H:i:s');

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

$friendRequest =  mysql_query("update FriendAlert set replydate = '$replydate', status = 'rejected' where fromsid = '$fromsid' and tosid = '$tosid' and requestdate = '$requestdate';");

if ($friendRequest) {
	echo "Friend Request Rejected Successfully!";
}

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>