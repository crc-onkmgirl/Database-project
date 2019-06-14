<?php session_start();?>
<?php 
$tosid = $_GET['tosid'];
$_SESSION['fwJobToSid'] = $tosid;
$fromsid = $_SESSION['sid'];

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

$getToName = mysql_query("select sname from Student where sid = $tosid");
$toName = mysql_fetch_row($getToName)[0];
echo "Foward Job to ".$toName."<br>";

$allJobs = mysql_query("select location, title, salary, jdgree as dgree, jmajor as major, description, postdate, jid from JobAnncmnt;");
echo "<table border=1 style=border-collapse:collapse>";
echo "<tr>";
for ($i = 0; $i < 7; $i++) {
	$attr = mysql_fetch_field($allJobs);
	echo "<td>$attr->name</td>";
}
echo "<td> </td></tr>";

while ($row = mysql_fetch_row($allJobs)) {
		echo "<tr>";
		echo "<td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td>";
		echo "<td>$row[3]</td>";
		echo "<td>$row[4]</td>";
		echo "<td>$row[5]</td>";
		echo "<td>$row[6]</td>";
		echo "<td><a href ='save-forwardjob.php?jid=".$row[7]."'>Forward</a></td>";
		echo "</tr>";
	}
echo "</table><br>";

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>