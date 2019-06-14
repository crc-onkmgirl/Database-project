<?php session_start();?>
<?php
$fsid = $_GET['fsid'];

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

$friendInfo = mysql_query("select sname, university, major, gpa, interest, qualification, resume from Student where sid = $fsid");
$info = mysql_fetch_row($friendInfo);

echo "<table border = 0>";
echo "<tr><td>Name:</td><td>$info[0]</td></tr>";
echo "<tr><td>University:</td><td>$info[1]</td></tr>";
echo "<tr><td>Major:</td><td>$info[2]</td></tr>";
echo "<tr><td>GPA:</td><td>$info[3]</td></tr>";
echo "<tr><td>Interest:</td><td>$info[4]</td></tr>";
echo "<tr><td>Qualification:</td><td>$info[5]</td></tr>";
echo "<tr><td>Resume:</td><td>$info[6]</td></tr></table>";

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>