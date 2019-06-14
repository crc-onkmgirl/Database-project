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

$friendRequest =  mysql_query("update FriendAlert set replydate = '$replydate', status = 'approved' where fromsid = '$fromsid' and tosid = '$tosid' and requestdate = '$requestdate';");
$friend1 = mysql_query("INSERT INTO Friend (sid1,sid2) VALUES ('$fromsid','$tosid');");
$friend2 = mysql_query("INSERT INTO Friend (sid2,sid1) VALUES ('$fromsid','$tosid');");
if ($friendRequest && $friend1 && $friend2) {
	echo "Friend Request Approved Successfully!";
}

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>