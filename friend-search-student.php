<?php session_start();?>
<?php 
$sid = $_SESSION['sid'];
$fsid = $_GET['fsid'];
date_default_timezone_set('America/New_York'); 
$requestdate = date('Y-m-d H:i:s');

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

$friendRequest = mysql_query("INSERT INTO FriendAlert (fromsid,tosid,requestdate,status) VALUES ('$sid','$fsid','$requestdate','pending');");
if ($friendRequest) {
	echo "Friend Request Sent Successfully!";
}

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>