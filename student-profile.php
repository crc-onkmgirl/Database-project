<?php session_start(); ?>

<?php
$sid = $_SESSION['sid'];

$conn = mysqli_connect('127.0.0.1','root','0224','project') or die('Could not connect: ' . mysql_error());

$studentProfile = mysqli_query($conn,"select * from Student where sid = $sid");
$row = mysqli_fetch_row($studentProfile);
$name = $row[1];
$university = $row[2];
$major = $row[3];
$gpa = $row[4];
$interest = $row[5];
$qualification = $row[6];
$restriction = $row[7];
$resume = $row[8];
echo "My Profile<br><br>";
echo "<form action = \"save-profile.php\" method = \"POST\">";
echo "<table border = 0>";
echo "<tr><td>Name:</td>";
echo "<td><input type = \"text\" name = \"sname\" value = $name /></td></tr>";

echo "<tr><td>University:</td>";
echo "<td><input type = \"text\" name = \"university\" value = $university /></td></tr>";

echo "<tr><td>Major:</td>";
echo "<td><input type = \"text\" name = \"major\" value = $major /></td></tr>";

echo "<tr><td>GPA:</td>";
echo "<td><input type = \"text\" name = \"gpa\" value = $gpa /></td></tr>";

echo "<tr><td>Interest:</td>";
echo "<td><input type = \"text\" name = \"interest\" value = $interest /></td></tr>";

echo "<tr><td>Qualification:</td>";
echo "<td><input type = \"text\" name = \"qualification\" value = $qualification /></td></tr>";

echo "<tr><td>Restriction:</td>";
echo "<td><input type = \"text\" name = \"restriction\" value = $restriction /></td></tr>";

echo "<tr><td>Resume:</td>";
echo "<td><input type = \"file\" name = \"resume\" value = $resume /></td></tr>";
echo "</table>";

echo "<input type = \"submit\" name = \"save\" value = \"Save\"/></form>";
?>

