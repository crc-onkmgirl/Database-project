<?php session_start();?>
<?php
$sid = $_SESSION['sid'];
$sname = $_POST['sname'];
$university = $_POST['university'];
$major = $_POST['major'];
$gpa = $_POST['gpa'];
$interest = $_POST['interest'];
$qualification = $_POST['qualification'];
$restriction = $_POST['restriction'];

$conn = mysqli_connect('127.0.0.1','root','0224','project') or die('Could not connect: ' . mysql_error());

$stmt = $conn->prepare("update Student set sname = ?, university = ?, major = ?, gpa = ? , interest = ? , qualification = ? , restriction = ? where sid = ? ");
$stmt->bind_param("sssdsssi",$sname,$university,$major,$gpa,$interest,$qualification,$restriction,$sid);
$stmt->execute();
$updateStudent = $stmt->get_result();
//$updateStudent = mysqli_query($conn, "update Student set sname = '$sname', university = '$university', major ='$major', gpa = '$gpa', interest = '$interest', qualification = '$qualification', restriction = '$restriction' where sid = '$sid';");

echo "Successfully saved";

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>