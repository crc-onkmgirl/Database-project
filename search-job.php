<?php session_start();?>
<?php
$searchText = $_SESSION['searchText'];
$sid = $_SESSION['sid'];

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

if ($searchText == ''){
	$searchJob = mysql_query("select cname as company, location, title, salary, jdgree as dgree, jmajor as major, description, postdate, jid from JobAnncmnt natural join Company;");
}else {
	$searchJob = mysql_query("select cname as company, location, title, salary, jdgree as dgree, jmajor as major, description, postdate, jid from JobAnncmnt natural join Company where title like '%$searchText%' or description like '%$searchText%';");
}

if (mysql_num_rows($searchJob) > 0) {
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 8; $i++) {
		$attr = mysql_fetch_field($searchJob);
		echo "<td>$attr->name</td>";
	}
	echo "<td> </td>";
	echo "</tr>";

	while ($row = mysql_fetch_row($searchJob)) {
		echo "<tr>";
		echo "<td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td>";
		echo "<td>$row[3]</td>";
		echo "<td>$row[4]</td>";
		echo "<td>$row[5]</td>";
		echo "<td>$row[6]</td>";
		echo "<td>$row[7]</td>";
		$jid = $row[8];
		$ifApplied = mysql_query("select * from (select jid from Apply where sid = '$sid') as a where jid = '$jid';");
		if (mysql_num_rows($ifApplied) > 0) {
			echo "<td>Applied</td>";
		} else {
			echo "<td><a href ='applyjob.php?jid=".$jid."'>Apply</a></td>";
		}
		echo "</tr>";
	}
	echo "</table><br>";
} else {
	echo "No Matching Job<br>";
}

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";

?>