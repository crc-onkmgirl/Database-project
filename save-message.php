<?php session_start();?>
<?php
$fromsid = $_SESSION['sid'];
$tosid = $_SESSION['msgToSid'];
$msgText = $_POST['msgText'];
date_default_timezone_set('America/New_York'); 
$dmdate = date('Y-m-d H:i:s');

$conn = mysqli_connect('127.0.0.1','root','0224','project') or die('Could not connect: ' . mysql_error());

$stmt = $conn->prepare("INSERT INTO DirectMessage (fromsid,tosid,dmdate,text) VALUES ('$fromsid','$tosid','$dmdate',?) ");
$stmt->bind_param("s",$msgText);
$stmt->execute();
//$saveMsg = mysqli_query($conn, "INSERT INTO DirectMessage (fromsid,tosid,dmdate,text) VALUES ('$fromsid','$tosid','$dmdate','$msgText');");
echo "Successfully Sent!<br>";

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>