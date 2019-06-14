<?php
session_start();
?>
<html>


<?php
$usr = $_SESSION['usr'];
$pwd = $_SESSION['pwd'];
$mode =  $_SESSION['button'];


$conn = mysqli_connect('127.0.0.1','root','0224','project') or die('Could not connect: ' . mysql_error());

if ($mode == 'Signup') {
	if ($usr == '' || $pwd == '') {
		echo "Username/Password can't be empty.";
		echo "<form action = \"signup.php\" method = \"post\">";
		echo "<input type =\"submit\" value = \"GoBack\"></form>";
	} else {
		$stmt = $conn->prepare('select * from LoginStudent where user = ?');
		$stmt->bind_param('s',$usr);
		$stmt->execute();
		$userExist = $stmt->get_result();
		//$userExist = mysqli_query($conn, "select * from LoginStudent where user = '$usr';");
		if (mysqli_num_rows($userExist) == 0) {
			$result1 = mysqli_query($conn, "INSERT INTO LoginStudent (user,password) VALUES ('$usr', '$pwd');");
			$getUserId = mysqli_query($conn, "select sid from LoginStudent where user = '$usr';");
			$sid = mysqli_fetch_row($getUserId)[0];
			$result2 = mysqli_query($conn, "INSERT INTO Student (sid) VALUES('$sid');");
			$flag = true;
		} else {
			echo "Username is used. Please select another one";
			echo "<form action = \"signup.php\" method = \"post\">";
			echo "<input type =\"submit\" value = \"GoBack\"></form>";
		}
	}
} else {
	if ($usr == '' || $pwd == '') {
		echo "Username/Password can't be empty.";
		echo "<form action = \"index.php\" method = \"post\">";
		echo "<input type =\"submit\" value = \"GoBack\"></form>";
	} else {
		$stmt = $conn->prepare('select password from LoginStudent where user = ?');
		$stmt->bind_param('s',$usr);
		$stmt->execute();
		$usrpassword = $stmt->get_result();
		//$usrpassword = mysqli_query($conn, "select password from LoginStudent where user = '$usr';");
		if (mysqli_num_rows($usrpassword) == 0) {
			echo "Account doesn't exist. Please sign up!";
			echo "<form action = \"signup.php\" method = \"post\">";
			echo "<input type =\"submit\" value = \"Go to SignUp\"></form>";
		} else if (mysqli_fetch_row($usrpassword)[0] != $pwd) {
			echo "Invalid Username/Password. Please try again.";
			echo "<form action = \"index.php\" method = \"post\">";
			echo "<input type =\"submit\" value = \"GoBack\"></form>";
		} else {
			$flag = true;
		}
	}
}
?>

<?php
if ($flag) {
	$stmt = $conn->prepare('select sid from LoginStudent where user = ?');
	$stmt->bind_param('s',$usr);
	$stmt->execute();
	$getUserId = $stmt->get_result();
	//$getUserId = mysqli_query($conn, "select sid from LoginStudent where user = '$usr';");
	$sid = mysqli_fetch_row($getUserId)[0];
	$_SESSION['sid'] = $sid;

	$getSname = mysqli_query($conn, "select sname from Student where sid = $sid;");
	$sname = mysqli_fetch_row($getSname)[0];
	echo "Welcome $sname!<br>";

	echo "<form action = \"student-profile.php\" method = \"POST\">";
	echo "<input type = \"submit\" name = \"sprofile\" value = \"MyProfile\"/></form>";

	echo "<form action = \"notification.php\" method = \"POST\">";
	echo "<input type = \"submit\" name = \"notif\" value = \"Notification\"/></form>";

	$followCompany = mysqli_query($conn, "select cname as name,headquarter,industry,cid from FollowCompany natural join Company where sid = $sid;");
	echo "Following Companies:";
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 3; $i++) {
		$attr = mysqli_fetch_field($followCompany);
		echo "<td>$attr->name</td>";
	}
	echo "</tr>";
	while ($row = mysqli_fetch_row($followCompany)) {
		echo "<tr><td><a href ='companyjobs.php?cid=".$row[3]."'>$row[0]</a></td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td></tr>";
	}
	echo "</table><br>";

	$friendList = mysqli_query($conn, "select sname, s.sid from student s, friend f where f.sid1 = $sid and f.sid2 = s.sid;");
	echo "Friends:";
	echo "<table border=1 style=border-collapse:collapse>";
	while ($row = mysqli_fetch_row($friendList)) {
		echo "<tr><td><a href ='friend-info.php?fsid=".$row[1]."'>$row[0]</a></td>";
		echo "<td><a href ='send-message.php?tosid=".$row[1]."'>Message</a></td>";
		echo "<td><a href ='forwardjob.php?tosid=".$row[1]."'>Forward Job</a></td></tr>";
	}
	echo "</table><br>";

	$appliedJob = mysqli_query($conn, "select title, location, cname, salary, applydate, status from Apply natural join JobAnncmnt natural join Company where sid = $sid; ");
	echo "AppliedJobs:";
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 6; $i++) {
		$attr = mysqli_fetch_field($appliedJob);
		echo "<td>$attr->name</td>";
	}
	echo "</tr>";
	while ($row = mysqli_fetch_row($appliedJob)) {
		echo "<tr>";
		echo "<td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		echo "<td>$row[2]</td>";
		echo "<td>$row[3]</td>";
		echo "<td>$row[4]</td>";
		echo "<td>$row[5]</td>";
		echo "</tr>";
	}
	echo "</table><br>";

	$followComPosition = mysqli_query($conn, "select cname as company, location, title, salary, jdgree as dgree, jmajor as major, description, postdate, jid from JobAnncmnt natural join Company where cid in (select cid from FollowCompany where sid = $sid);");
	echo "Followed Company Job Announcements:";
	echo "<table border=1 style=border-collapse:collapse>";
	echo "<tr>";
	for ($i = 0; $i < 8; $i++) {
		$attr = mysqli_fetch_field($followComPosition);
		echo "<td>$attr->name</td>";
	}
	echo "<td> </td>";
	echo "</tr>";
	while ($row = mysqli_fetch_row($followComPosition)) {
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
		$ifApplied = mysqli_query($conn, "select * from (select jid from Apply where sid = '$sid') as a where jid = '$jid';");
		if (mysqli_num_rows($ifApplied) > 0) {
			echo "<td>Applied</td>";
		} else {
			echo "<td><a href ='applyjob.php?jid=".$jid."'>Apply</a></td>";
		}
		echo "</tr>";
	}
	echo "</table><br>";

	echo "<form action = \"search-select-page.php\" method = \"POST\">";
	echo "<table border = 0>";
	echo "<tr>";
	echo "<td><input type = \"text\" name = \"searchText\"/><br>";
	echo "<input type=\"radio\" name=\"searchType\" value=\"company\"/> Company <br>";
	echo "<input type=\"radio\" name=\"searchType\" value=\"student\"/> Student <br>";
	echo "<input type=\"radio\" name=\"searchType\" value=\"job\"/> Job </td>";
	echo "<td><input type = \"submit\" name = \"search\" value = \"Search\"/></td></tr>";
	echo "</table></form>";

	echo "<form action = \"index.php\" method = \"post\">";
	echo "<input type =\"submit\" value = \"Logout\"></form>";

}
?>
</html>







