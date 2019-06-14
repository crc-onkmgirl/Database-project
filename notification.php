<?php session_start();?>
<?php
$sid = $_SESSION['sid'];

$con = mysql_connect("127.0.0.1","root","0224");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sel = mysql_select_db('project');
if (!$sel) {
	die('cannot select database');
}

echo "Pending Friend Requests:<br>";

$pendingFriend = mysql_query("select sname as name, requestdate, fromsid, tosid from FriendAlert fa, Student s where fa.fromsid = s.sid and fa.status = 'pending' and fa.tosid = '$sid';");

if (mysql_num_rows($pendingFriend) > 0) {
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 2; $i++) {
		$attr = mysql_fetch_field($pendingFriend);
		echo "<td>$attr->name</td>";
	}
	echo "<td> </td>";
	echo "<td> </td>";
	echo "</tr>";

	while ($row = mysql_fetch_row($pendingFriend)) {
		echo "<tr>";
		echo "<td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		echo "<td><a href ='approvefriend.php?fromsid=".$row[2]."&tosid=".$row[3]."&requestdate=".$row[1]."'>Approve</a></td>";
		echo "<td><a href ='rejectfriend.php?fromsid=".$row[2]."&tosid=".$row[3]."&requestdate=".$row[1]."'>Reject</a></td>";
		echo "</tr>";
	}
	echo "</table><br>";
} else {
	echo "Null<br><br>";
}

echo "Chat:<br>";
$message = mysql_query("select sname as fromStudent, dmdate, text from Student s, DirectMessage d where d.fromsid = s.sid and d.tosid = '$sid';");
if (mysql_num_rows($message) > 0) {
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 3; $i++) {
		$attr = mysql_fetch_field($message);
		echo "<td>$attr->name</td>";
	}
	echo "</tr>";
	while ($row = mysql_fetch_row($message)) {
		echo "<tr>";
		echo "<td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td>";
		echo "</tr>";
	}
	echo "</table><br>";
} else {
	echo "Null<br><br>";
}

echo "Unchecked Forward Job Announcements by Friends:<br>";

$unckkdFwJob = mysql_query("select sname as ForwardBy, location, title, salary, jdgree as dgree, jmajor as major, description, postdate,fj.jid, fj.fromsid, fj.tosid, fj.forwarddate from ForwardJob fj, Student s, JobAnncmnt j where j.jid = fj.jid and fj.fromsid = s.sid and fj.status = 'unchecked' and fj.tosid = '$sid';");

if (mysql_num_rows($unckkdFwJob) > 0) {
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 8; $i++) {
		$attr = mysql_fetch_field($unckkdFwJob);
		echo "<td>$attr->name</td>";
	}
	echo "<td> </td>";
	echo "<td> </td>";
	echo "</tr>";

	while ($row = mysql_fetch_row($unckkdFwJob)) {
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
			echo "<td><a href ='apply-fwjob.php?jid=$jid&fromsid=$row[9]&tosid=$row[10]&forwarddate=$row[11]'>Apply</a></td>";
		}
		echo "<td><a href ='ignore-fwjob.php?jid=$jid&fromsid=$row[9]&tosid=$row[10]&forwarddate=$row[11]'>Ignore</a></td>";
		echo "</tr>";
	}
	echo "</table><br>";
} else {
	echo "Null<br><br>";
}

echo "Pushed Job Announcements by Companies:<br>";

$pushedJob = mysql_query("select cname as company, location, title, salary, jdgree as dgree, jmajor as major, description, postdate, pushdate, jid from PushJob natural join JobAnncmnt natural join Company where sid = '$sid' and status = 'unchecked';");

if (mysql_num_rows($pushedJob) > 0) {
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 9; $i++) {
		$attr = mysql_fetch_field($pushedJob);
		echo "<td>$attr->name</td>";
	}
	echo "<td> </td>";
	echo "<td> </td>";
	echo "</tr>";

	while ($row = mysql_fetch_row($pushedJob)) {
		echo "<tr>";
		echo "<td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td>";
		echo "<td>$row[3]</td>";
		echo "<td>$row[4]</td>";
		echo "<td>$row[5]</td>";
		echo "<td>$row[6]</td>";
		echo "<td>$row[7]</td>";
		echo "<td>$row[8]</td>";
		$jid = $row[9];
		$ifApplied = mysql_query("select * from (select jid from Apply where sid = '$sid') as a where jid = '$jid';");
		if (mysql_num_rows($ifApplied) > 0) {
			echo "<td>Applied</td>";
		} else {
			echo "<td><a href ='apply-pushjob.php?jid=$jid&pushdate=$row[8]'>Apply</a></td>";
		}
		echo "<td><a href ='ignore-pushjob.php?jid=$jid&pushdate=$row[8]'>Ignore</a></td>";
		echo "</tr>";
	}
	echo "</table><br>";
} else {
	echo "Null<br>";
}

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";

?>