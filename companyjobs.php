<?php session_start(); ?>
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

$companyName = mysql_query("select cname from Company where cid = $cid;");
echo "All the job announcements by ";
echo mysql_fetch_row($companyName)[0];
echo "<br>";

$allJobs = mysql_query("select location, title, salary, jdgree as dgree, jmajor as major, description, postdate,jid from JobAnncmnt where cid = $cid;");
echo "<table border=1 style=border-collapse:collapse>";
echo "<tr>";
for ($i = 0; $i < 7; $i++) {
	$attr = mysql_fetch_field($allJobs);
	echo "<td>$attr->name</td>";
}
echo "<td> </td>";
echo "</tr>";
while ($row = mysql_fetch_row($allJobs)) {
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5]</td>";
	echo "<td>$row[6]</td>";
	$jid = $row[7];
	$ifApplied = mysql_query("select * from (select jid from Apply where sid = '$sid') as a where jid = '$jid';");
	if (mysql_num_rows($ifApplied) > 0) {
		echo "<td>Applied</td>";
	} else {
		echo "<td><a href ='applyjob.php?jid=".$jid."'>Apply</a></td>";
	}
	echo "</tr>";
}
echo "</table>";

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";

?>