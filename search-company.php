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
	$searchCompany = mysql_query("select cname as company, headquarter, industry, cid from Company;");
}else {
	$searchCompany = mysql_query("select cname as company, headquarter, industry, cid from Company where cname = '$searchText';");
}

if (mysql_num_rows($searchCompany) > 0) {
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 3; $i++) {
		$attr = mysql_fetch_field($searchCompany);
		echo "<td>$attr->name</td>";
	}
	echo "<td> </td></tr>";
	while ($row = mysql_fetch_row($searchCompany)) {
		echo "<tr><td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td>";

		$cid = $row[3];
		$ifFollowing = mysql_query("select * from FollowCompany where sid = $sid and cid = $cid;");
		if (mysql_num_rows($ifFollowing) > 0) {
			echo "<td>Following</td>";
		} else {
			echo "<td><a href ='follow-search-company.php?cid=$cid'>Follow</a></td>";
		}
		echo "</tr>";
	}
	echo "</table><br>";
} else {
	echo "No Matching Company<br>";
}
echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>