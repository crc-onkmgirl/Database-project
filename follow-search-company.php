<?php session_start();?>
<?php
$cid = $_GET['cid'];
$sid = $_SESSION['sid'];

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

$followCompany = mysql_query("INSERT INTO FollowCompany (sid,cid) VALUES ('$sid','$cid');");
if ($followCompany) {
	echo "Successfully Follow!";
}

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>