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
	$searchStudent = mysql_query("select sname as name, university, major, sid from Student where sid != '$sid';");
}else {
	$searchStudent = mysql_query("select sname as name, university, major, sid from Student where sname = '$searchText' and sid != '$sid';");
}

if (mysql_num_rows($searchStudent) > 0) {
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 3; $i++) {
		$attr = mysql_fetch_field($searchStudent);
		echo "<td>$attr->name</td>";
	}
	echo "<td> </td></tr>";
	while ($row = mysql_fetch_row($searchStudent)) {
		echo "<tr><td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td>";

		$fsid = $row[3];
		$ifFriend = mysql_query("select * from Friend where sid1 = $sid and sid2 = $fsid;");
		if (mysql_num_rows($ifFriend) > 0) {
			echo "<td>Friend :)</td>";
		} else {
			echo "<td><a href ='friend-search-student.php?fsid=$fsid'>Add Friend</a></td>";
		}
		echo "</tr>";
	}
	echo "</table><br>";
} else {
	echo "No Matching Student<br>";
}
echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>